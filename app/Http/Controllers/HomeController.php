<?php

namespace App\Http\Controllers;

use App\Credit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function __construct()
    {
/*
        //$this->middleware('auth');
        if (Auth::check()) {
            return Redirect::to('/admin-home');
        } else {
            echo "No";
        }*/

    }


    public function index()
    {
        return view('home');
    }

    public function doLogin(Request $request)
    {
        $email = $request['email'];
        $password = $request['password'];
        $remember = true;

        // attempt to do the login
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {

            $user = User::where('email', $email)->first();
            $request->session()->put('id', $user->id);

            return Redirect::to('/admin-home');
        } else {
            return back()->with('failed', "Email or password does not match");

        }
        //Auth::logout(); // log the user out of our application
    }

    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('/');
    }
}
