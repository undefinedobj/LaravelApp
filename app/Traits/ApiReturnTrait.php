<?php

namespace App\Traits;

use \Illuminate\Support\Facades\Response;

/**
 * Trait ApiReturnTrait
 * @package App\Traits
 */
trait ApiReturnTrait
{
    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @var string
     */
    protected $message = 'Success';

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message = 'Failed')
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return $this
     */
    public function setStatusCode(int $statusCode = 404)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseError()
    {
        return $this->response([
            'status_code'   =>  $this->getStatusCode(),
            'message'       =>  $this->getMessage(),
        ]);
    }

    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseSuccess(array $data)
    {
        return  $this->response([
            'count'         =>  collect($data)->count(),
            'status_code'   =>  $this->getStatusCode(),
            'message'       =>  $this->getMessage(),
            'data'          =>  $data
        ]);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function response($data)
    {
        return  Response::json($data);
    }

//    public function responseNotFound($message = 'Not Found')
//    {
//        return  $this->responseError();
//    }
}
