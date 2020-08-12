<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckRegisterForm;
use App\Http\Requests\CheckAuthForm;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getSignup(){
        return view('register');
    }

    public function postSignup(CheckRegisterForm $request){
       User::create([
        'name' => $request->input('userName'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
        'country' => $request->input('userCountry'),
       ]);

       return redirect()->route('chat')->with('info', 'Congratulation!!!');

    }

    public function postSignin(CheckAuthForm $request){
        // dd($request);
        if(!Auth::attempt($request->only('email', 'password'))){
            return redirect()->back('welcome')->with('info', 'You are not auth!!! Please try late');

        }
        // User::create([
        //  'name' => $request->input('userName'),
        //  'email' => $request->input('email'),
        //  'password' => Hash::make($request->input('password')),
        //  'country' => $request->input('userCountry'),
        // ]);
 
        // return redirect()->route('welcome')->with('Congratulation!!!');
 
     }
}