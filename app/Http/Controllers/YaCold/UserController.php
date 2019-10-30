<?php

namespace App\Http\Controllers\YaCold;

use App\Models\YaCold\Line;
use App\Models\YaCold\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        $lines = Line::all();

//        $users = \DB::table('ya_cold_users')
//            ->join('ya_cold_discounts', 'ya_cold_users.id', '=', 'ya_cold_discounts.user_id')
//            ->select('ya_cold_users.*', 'ya_cold_discounts.discount', 'ya_cold_discounts.id AS ya_cold_discounts_id')
//            ->get();

//        dd($users);

        return view('ya-cold.user', compact('users', 'lines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'username' => 'required|min:4|unique:ya_cold_users,username',
            'password' => 'required|min:6|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            //return $validator->errors();
            return back()->with('errors', $validator->errors());
        }

        $user = new User();
        $user->username = $request->username;
        $user->password = \Hash::make($request->password);
        $user->save();

        return 1;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('ya-cold.user-edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::where('id', $request->id)
            ->update(['username' => $request->username]);

        if ($user) {
            return redirect()->route('cold.users');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::destroy($request->id);

        return $user;
    }
}
