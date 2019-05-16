<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TestsCreateRequest;
use App\Http\Requests\TestsUpdateRequest;
use App\Repositories\TestsRepository;
use App\Validators\TestsValidator;

/**
 * 本控制器仅用于 Laravel 5 Repositories 试验, 与项目业务 无任何关系
 * Class TestsController.
 *
 * @package namespace App\Http\Controllers;
 */
class TestsController extends Controller
{
    /**
     * @var TestsRepository
     */
    protected $repository;

    /**
     * @var TestsValidator
     */
    protected $validator;

    /**
     * TestsController constructor.
     *
     * @param TestsRepository $repository
     * @param TestsValidator $validator
     */
    public function __construct(TestsRepository $repository, TestsValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $tests = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tests,
            ]);
        }

        return view('tests.index', compact('tests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TestsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TestsCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $test = $this->repository->create($request->all());

            $response = [
                'message' => 'Tests created.',
                'data'    => $test->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
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
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $test,
            ]);
        }

        return view('tests.show', compact('test'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $test = $this->repository->find($id);

        return view('tests.edit', compact('test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TestsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TestsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $test = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Tests updated.',
                'data'    => $test->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
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
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Tests deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Tests deleted.');
    }
}
