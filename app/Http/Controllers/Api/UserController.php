<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Discussion;
use App\Transformer\DiscussionTransformer;
use App\Traits\ApiReturnTrait;

class UserController extends Controller
{
    use ApiReturnTrait;

    /**
     * @var $transformer
     */
    protected $transformer;

    /**
     * UserController constructor.
     * @param DiscussionTransformer $transformer
     */
    public function __construct(DiscussionTransformer $discussionTransformer)
    {
        $this->transformer = $discussionTransformer;
        $this->middleware('auth.basic', ['only' => 'store', 'update']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $discussions = Discussion::all();

        $data = $this->transformer->transformCollection($discussions->toArray());

        return $this->setStatusCode(200)->setMessage('a b c d')->responseSuccess($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $discussion = Discussion::find($id);

        if (! $discussion) {
            return $this->setStatusCode(404)->setMessage('not ... found')->responseError();
        }

        $data = $this->transformer->transformer($discussion->toArray());

        return $this->responseSuccess($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if (! $request->title or ! $request->body) {
            return $this->setStatusCode(422)->setMessage('validate fails')->responseError();
        }

        $array = [
            'user_id'       => 1,
            'last_user_id'  => 1
        ];

        $discussion = Discussion::create(array_merge($request->all(), $array));

        $data = $this->transformer->transformer($discussion->toArray());

        return $this->responseSuccess($data);
    }

    public function update(Request $request)
    {
        
    }

}
