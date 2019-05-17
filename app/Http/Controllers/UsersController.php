<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Carbon\Carbon;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param UserValidator $validator
     */
    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function register()
    {
        return view('users.register');
    }

    public function login()
    {
        return view('users.login');
    }

    public function singIn(UserLoginRequest $request)
    {
        $user = $this->repository->findByField('email', $request->email)->first();

//        登录验证并保存 Auth
        if (Auth::attempt([
            'email'         => $request->email,
            'password'      => $request->password,
            'is_confirmed'  => 1,
        ])) {
            return redirect('/');
        }

        Session::flash('user_login_failed', "请填写正确的邮箱和密码, 并激活邮箱");
        return redirect('/user/login')->withInput();

//        更为详细的「登录验证错误反馈」方式
//        if (! $user) {
//            Session::flash('user_login_failed', '请输入正确的邮箱');
//            return redirect('/user/login')->withInput();
//        }
//
//        if (! Hash::check($request->password, $user->password)) {
//            Session::flash('user_login_failed', '请输入正确的密码');
//            return redirect('/user/login')->withInput();
//        }
//
//        if ($user->is_confirmed != 1 || is_null($user->email_verified_at)) {
//            Session::flash('user_login_failed', "请先激活您的 $user->email 邮箱");
//            return redirect('/user/login')->withInput();
//        }
//
//        session(['user' => $user]);
//        return redirect('/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $users = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $users,
            ]);
        }

        return view('users.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(UserRegisterRequest $request)
    {
        try {
            $request->flash();
            $data = [
                'confirm_code'      => \Str::random(48),
                'avatar'            => '/images/default-avatar.jpg',
                'password'          => bcrypt($request->password)
            ];

            $this->validator->with(array_merge($request->all(), $data))->passesOrFail(ValidatorInterface::RULE_CREATE);

            $user = $this->repository->create(array_merge($request->all(), $data));

            Mail::to($user->email)->send(new \App\Mail\RegisterMail($user));

            return redirect('/');

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

    public function confirmEmail($confirm_code)
    {
        $user = $this->repository->findByField('confirm_code', $confirm_code)->first();

        if (is_null($user)) {
            return redirect('/');
        }

        $update = [
            'is_confirmed'      => 1,
            'confirm_code'      => \Str::random(48),
            'email_verified_at' => Carbon::now()
        ];

        $this->repository->update( $update, $user->id );

        return redirect('user/login');
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
        $user = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $user,
            ]);
        }

        return view('users.show', compact('user'));
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
        $user = $this->repository->find($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $user = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'User updated.',
                'data'    => $user->toArray(),
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
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'User deleted.');
    }
}
