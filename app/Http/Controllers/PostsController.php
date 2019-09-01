<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscussionCreateRequest;
use App\Http\Requests\DiscussionUpdateRequest;
use App\Repositories\DiscussionRepository;
use App\Validators\DiscussionValidator;
use App\Transformers\DiscussionTransformer;
use http\Client\Curl\User;
use HyperDown\Parser;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use EndaEditor;
use function foo\func;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['id','title','preface','img','body','user_id','created_at'];

        $discussions = $this->repository->with([
            'user' => function($query){
                $query->select('id','name','avatar');
            },
            'comments' => function($query){
                $query->select('id', 'discussion_id');
            },
        ])->orderBy('updated_at', 'desc')
            ->orderBy('sort', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(null, $columns);

        return  view('forum.index', compact('discussions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('forum.create');
    }

    /**
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
            $data = [
                'user_id'       =>   (int) \Auth::user()->id,
                'last_user_id'  =>   (int) \Auth::user()->id,
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
        ])->find($id, ['id', 'title', 'body', 'preface', 'user_id']);

        $html = $parser->makeHtml($discussion->body);

        return  view('forum.show', compact('discussion', 'html'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discussion = $this->repository->find($id);

        if (\Auth::user()->id !== $discussion->user_id) {
            return redirect('/');
        }

        return view('forum.edit', compact('discussion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DiscussionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(DiscussionUpdateRequest $request, $id)
    {
        try {
            $data = [
                'user_id'       =>   (int) \Auth::user()->id,
                'last_user_id'  =>   (int) \Auth::user()->id,
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
