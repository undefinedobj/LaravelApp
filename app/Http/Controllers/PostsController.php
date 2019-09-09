<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscussionCreateRequest;
use App\Http\Requests\DiscussionUpdateRequest;
use App\Models\Category;
use App\Models\Discussion;
use App\Repositories\DiscussionRepository;
use App\Validators\DiscussionValidator;
use App\Transformers\DiscussionTransformer;
use HyperDown\Parser;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\Facades\Cache;
use EndaEditor;

class PostsController extends Controller
{
    /**
     * @var DiscussionRepository
     */
    protected $repository;

    /**
     * @var DiscussionValidator
     */
    protected $validator;

    /**
     * @var DiscussionTransformer
     */
    protected $transformer;

    /**
     * PostsController constructor.
     *
     * @param DiscussionRepository $repository
     * @param DiscussionValidator $validator
     * @param DiscussionTransformer $transformer
     */
    public function __construct(DiscussionRepository $repository, DiscussionValidator $validator, DiscussionTransformer $transformer)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->transformer  = $transformer;
        $this->middleware('auth', ['only' => ['create','store','edit','update']]);
    }

    /**
     * 应用首页
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['id','title','preface','img','categories_id','user_id','user_id','created_at'];

        $discussions = $this->repository->with([
            'user' => function($query){
                $query->select('id','name','avatar');
            },
            'comments' => function($query){
                $query->select('id', 'discussion_id');
            },
            'category' => function($query){
                $query->select('id', 'title');
            },
        ])->orderBy('updated_at', 'desc')
            ->orderBy('order', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(config('app.perPage'), $columns);

        return  view('forum.index', compact('discussions'));
    }

    /**
     * 发布帖子视图页
     *
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('parent_id', '!=', 0)->pluck('title', 'id');

        return  view('forum.create', compact('category'));
    }

    /**
     * 存储帖子
     *
     * Store a newly created resource in storage.
     *
     * @param  DiscussionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(DiscussionCreateRequest $request)
    {
        try {
            # 文件上传
            $strategy = $request->get('strategy', 'images');

            if (! $request->hasFile('img')) {
                return response()->json([
                    'error'   => true,
                    'message' => 'no file found'
                ]);
            }

            $path = $strategy.'/'.date('Y').'/'.date('m').'/'.date('d');
            $imgPath = config('app.url').'/uploads/'.$request->file('img')->store($path, 'picture');

            $data = [
                'user_id'       =>   (int) \Auth::user()->id,
                'last_user_id'  =>   (int) \Auth::user()->id,
                'img'           =>    $imgPath
            ];

            $this->validator->with(array_merge($request->all(), $data))->passesOrFail(ValidatorInterface::RULE_CREATE);

            $discussion = $this->repository->create(array_merge($request->all(), $data));

            $response = [
                'message' => 'Discussion created.',
                'data'    => $discussion->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->action('PostsController@show', ['id'=>$discussion->id]);

        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }

    }

    /**
     * 帖子详情视图页  MySQL + Redis 实现浏览数 （未完成）
     *
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Parser $parser/*, Discussion $discussion*/)
    {
        // 如:在 cache 中查找 discussion_5 的文章, 过期时间为: 当前时间 + 1天
        if (Cache::has('discussion_'.$id)){
            $cache = Cache::get('discussion_'.$id);
        }else{

            $columns = ['id', 'title', 'view_count', 'body', 'preface', 'user_id', 'created_at'];

            $cache = $this->repository->with([
                'comments' => function($query){
                    $query->select('id','body','user_id','discussion_id');
                },
                'comments.user' => function($query){
                    $query->select('id','name','avatar');
                },
            ])->find($id, $columns);

            Cache::put('discussion_'.$id, $cache, now()->addDay());
        }

        $html = $parser->makeHtml($cache->body);

        return  view('forum.show', ['discussion' => $cache, 'html' => $html]);

//        // (MySQL + Redis 实现浏览数) 未完成
//        /*$discussion->viewCountIncrement(); // 自增浏览数
//
//        dd($discussion->view_count); // 获取浏览数*/
//
//        return  view('forum.show', ['discussion' => $model, 'html' => $html]);
    }

    /**
     * 帖子编辑视图页
     *
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $columns = ['id','title','order','body','preface','img','user_id'];

        $discussion = $this->repository->find($id, $columns);

        $category = Category::where('parent_id', '!=', 0)->pluck('title', 'id');

        if (\Auth::user()->id !== $discussion->user_id) {
            return redirect('/');
        }

        return view('forum.edit', compact('discussion', 'category'));
    }

    /**
     * 更新帖子
     *
     * Update the specified resource in storage.
     *
     * @param DiscussionUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(DiscussionUpdateRequest $request, $id)
    {
        try {
            # 文件上传
            if ($request->hasFile('img')) {
                $strategy = $request->get('strategy', 'images');
                $path = $strategy.'/'.date('Y').'/'.date('m').'/'.date('d');
                $imgPath = config('app.url').'/uploads/'.$request->file('img')->store($path, 'picture');
            }

            $data = [
                'user_id'       =>   (int) \Auth::user()->id,
                'last_user_id'  =>   (int) \Auth::user()->id,
                'img'           =>    $imgPath ?? $request->get('hidden-img')
            ];

            $this->validator->with(array_merge($request->all(), $data))->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $discussion = $this->repository->update(array_merge($request->all(), $data), $id);

            $response = [
                'message' => 'Discussion updated.',
                'data'    => $discussion->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->action('PostsController@show', ['id'=>$discussion->id]);

        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Markdown 编辑器 - 中的图片上传
     *
     * @return false|string
     */
    public function markdownUpload()
    {

        // path 为 public 下面目录，比如我的图片上传到 public/uploads 那么这个参数你传 uploads 就行了

        $data = EndaEditor::uploadImgFile('uploads');

        return json_encode($data);

    }
}
