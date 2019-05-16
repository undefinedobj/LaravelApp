<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
//use Naux\Mail\SendCloudException;

class UsersController extends Controller
{
    public function register()
    {
        return view('users.register');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegisterRequest $request)
    {
        $request->flash();
        $data = [
            'confirm_code' => \Str::random(48),
            'avatar'=>'/images/default-avatar.jpg'
        ];
        $user = User::create(array_merge($request->all(), $data));

        $subject = 'Confirm Your Email';
        $view = 'email.register';

        $this->sendTo($user, $subject, $view, $data);
        return redirect('/');

//        \Mail::send('emails.welcome', $data, function ($message) {
//            $message->from('us@example.com', 'Laravel');
//            $message->to('foo@example.com')->cc('bar@example.com');
//        });
    }

    public function confirmEmail($confirm_code)
    {
        $user = User::where('confirm_code', $confirm_code)->first();

        if (is_null($user)) {
            return redirect('/');
        }

        $user->is_confirmed = 1;
        $user->confirm_code = \Str::random(48);
        $user->save();
//        \Session::flash('email_confirm', '');

        return redirect('user/login');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function sendTo($user, $subject, $view, $data=[])
    {
         Mail::queue($view, $data, function ($message) use ($user, $subject){
                 $message->from('john@johndoe.com', 'John Doe');
                 $message->sender('john@johndoe.com', 'John Doe');

                 $message->to($user->email->subject($subject));

                 $message->cc('john@johndoe.com', 'John Doe');
                 $message->bcc('john@johndoe.com', 'John Doe');

                 $message->replyTo('john@johndoe.com', 'John Doe');

                 $message->subject('Subject');

                 $message->priority(3);

                 $message->attach('pathToFile');
             });
    }
}
