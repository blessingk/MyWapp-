<?php

namespace App\Http\Controllers;

use App\Users;
use App\Validation\Validator;
use Illuminate\Http\Request;
use App\User;
use response;
use Illuminate\Support\Facades\input;
use App\Http\Requests;


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

        $user = Users::findOrFail($request->id);
        $user->delete();

        return back();

    }

    public function loginUser(Request $request)
    {

        //validate form data

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        //attempt to login
        if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return view('home');
        }
        return redirect()->back();
    }



}
