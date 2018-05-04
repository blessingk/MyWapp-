<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Image;
use App\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function updateProfile(Request $request)
    {
        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );

        $user = Auth::user();
        $user->avatar = $filename;
        $user->save();

    return view('home', array('user' => Auth::user()) );
    }

    public function updateInfo(Request $request)
    {
        $name = $request->input('name');
        $sname = $request->input('surname');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $comp = $request->input('company');
        $pass = $request->input('password');

        $user = Auth::user();
        $user->name = $name;
        $user->surname =$sname;
        $user->phone = $phone;
        $user->email = $email;
        $user->company = $comp;
        $user->password = bcrypt($pass);
        $user->save();

        return view('home', array('user' => Auth::user()) );

    }

}
