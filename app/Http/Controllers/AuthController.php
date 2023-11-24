<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        //validate data
        $credential = $request->validate([
            'email'=> 'required',
            'password' => 'required'
        ]);

        //login code
        if(\Auth::attempt($request->only('email','password'))){
            return redirect('home');
        }
        //error message
        return redirect('login')->withError('login details are not valid');
        
    }

    public function register_view()
    {
        return view('auth.register');
    }

    // public function register(Request $request)
    // {
    //     dd($request->all());
    // }

    public function register(Request $request) 
    {
        //validate
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed'
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> \Hash::make($request->password)
           
        ]);

        //login user here
        if(\Auth::attempt($request->only('email','password'))){
            return redirect('home');
        }
        //error message
        return redirect('register')->withError('Error');
    }

    public function home()
    {
        return view('home');
    }

    public function logout()
    {
        \Session::flush();
        \Auth::logout();
        return redirect('');    
    }
}
