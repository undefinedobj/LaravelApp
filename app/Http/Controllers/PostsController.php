<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscussionCreateRequest;
use App\Http\Requests\DiscussionUpdateRequest;
use App\Repositories\DiscussionRepository;
use App\Validators\DiscussionValidator;
use App\Transformers\DiscussionTransformer;
use HyperDown\Parser;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

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
        $columns = ['id','title','body','user_id'];

        $discussions = $this->repository->paginate(null, $columns);

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
        $discussion = $this->repository->find($id);

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
}
