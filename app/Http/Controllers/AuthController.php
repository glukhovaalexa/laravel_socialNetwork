<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckAuthForm;

class AuthController extends Controller
{
    public function getSignup(){
        return view('register');
    }

    public function postSignup(CheckAuthForm $request){
        // return view('register');
        dd($request);
        // $validated = $request->validated();
        // dd($validated);

    }
}
