<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscussionCreateRequest;
use App\Http\Requests\DiscussionUpdateRequest;
use App\Models\Category;
use App\Repositories\DiscussionRepository;
use App\Validators\DiscussionValidator;
use App\Transformers\DiscussionTransformer;
use HyperDown\Parser;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
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
        //$columns = ['id','title','preface','img','body','user_id','created_at'];

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
            ->paginate(config('app.perPage'));
            //->paginate(null, $columns);

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
     * 帖子详情视图页
     *
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Parser $parser)
    {
        $discussion = $this->repository->with([
            'comments' => function($query){
                $query->select('id','body','user_id','discussion_id');
            },
            'user' => function($query){
                $query->select('id','name','avatar');
            },
        ])->find($id, ['id', 'title', 'reading', 'body', 'preface', 'user_id', 'created_at']);

        $html = $parser->makeHtml($discussion->body);

        return  view('forum.show', compact('discussion', 'html'));
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
        $discussion = $this->repository->find($id);

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
