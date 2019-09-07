<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAvatarUpdateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Comment;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Mail\RegisterMail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Avatar;

class UsersController extends Controller
{
    use RegistersUsers;

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

    /**
     * 登录视图页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('users.login');
    }

    /**
     * 用户登录
     *
     * @param UserLoginRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function signIn(UserLoginRequest $request)
    {
        // 登录验证并保存 Auth
        if (Auth::attempt([
            'email'         => $request->email,
            'password'      => $request->password,
        ])) {
            return redirect('/');
        }

        Session::flash('user_login_failed', "请填写正确的邮箱和密码");
        return redirect('/user/login')->withInput();
    }

    /**
     * 注册视图页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register()
    {
        return view('users.register');
    }

    /**
     * 用户注册
     *
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

            Avatar::create("$request->name")->save($avatar = 'images/'.$request->name.uniqid('_').'.jpg', 100);

            $data = [
                'confirm_code'      => \Str::random(48),
                'avatar'            => config('app.url').'/'.$avatar,
                'password'          => bcrypt($request->password)
            ];

            $this->validator->with(array_merge($request->all(), $data))->passesOrFail(ValidatorInterface::RULE_CREATE);

            $user = $this->repository->create(array_merge($request->all(), $data));

//            将邮件推送到队列
            $message = (new RegisterMail($user))
                ->onConnection('redis')
                ->onQueue('emails');

            Mail::to($user->email)->queue($message);

//             登录
            $this->guard()->login($user);

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

    /**
     * 退出登录
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        \Auth::logout();
        return redirect('/');
    }

    /**
     * 头像视图页
     *
     * User Avatar View
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function avatar()
    {
        return  view('users.avatar');
    }

    /**
     * 更新头像
     *
     * Update the specified resource in storage.
     *
     * @param  UserAvatarUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function updateAvatar(UserAvatarUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            // upload files
            $file = $request->avatar;
            $timestamp = Carbon::now()->timestamp;
            $filepath = '/uploads/avatar/'.Auth::user()->id.'_'.$timestamp.'_'.$file->getClientOriginalName();

            // intervention image
            Image::make($file)->resize(200, 200)->save(public_path($filepath));

            $this->repository->update(['avatar' => $filepath], $id);

            return redirect()->action('UsersController@avatar');
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
     * 个人中心
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function person()
    {
        $id = Auth::user()->id;

        $comments = Comment::with('discussion')
            ->where('user_id', $id)
            ->paginate(config('app.perPage'));

        return view('users.person', compact('comments'));
    }

    // ============================以下为无用代码==============================

    /**
     * 邮箱验证(此功能废弃)
     *
     * @param $confirm_code
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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
