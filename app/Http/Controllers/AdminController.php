<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use response;
use App\Http\Requests;
use Auth;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('users.index', compact('user'));
    }

    public function store(Request $request)
    {

        User::create($request->all());

        return back();

    }

    public function update(Request $request)
    {

        $user = User::findOrFail($request->id);

        $user->update($request->all());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $user = User::findOrFail($request->id);
        $user->delete();

        return back();

    }

    public function login(Request $request)
    {

        //validate form data

        $email = $request->input('email');
        $pass = $request->input('password');
        $user = Auth::user();
        $user->email = $email;
        $user->password = bcrypt($pass);
//        //attempt to login
        if(Auth::guard('admin')->login($user)) {
            return view('home');
        }
        return redirect()->back();
    }



}
