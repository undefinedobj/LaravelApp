<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Transformer\UserTransformer;
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
     * @param UserTransformer $transformer
     */
    public function __construct(UserTransformer $userTransformer)
    {
        $this->transformer = $userTransformer;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::all();

        $data = $this->transformer->transformCollection($users->toArray());

        return $this->setStatusCode(200)->setMessage('a b c d')->responseSuccess($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = User::find($id);

        if (! $user) {
            return $this->setStatusCode(404)->setMessage('not ... found')->responseError();
        }

        $data = $this->transformer->transformer($user->toArray());

        return $this->responseSuccess($data);
    }
}
