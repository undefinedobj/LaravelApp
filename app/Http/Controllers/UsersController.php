<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
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

//        \Mail::send('emails.welcome', $data, function ($message) {
//            $message->from('us@example.com', 'Laravel');
//            $message->to('foo@example.com')->cc('bar@example.com');
//        });
//        return redirect('/');
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

    public function sendTo($user, $subject, $view, $data)
    {
        
    }
}
