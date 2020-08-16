<?php

namespace App\Http\Controllers;

use DB;
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
        'phone' => $request->input('phone'),
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
            // dd('dvdvd!');
            return redirect()->action('WelcomeController@welcome')->with('info', 'Password or login incorrect');

        }
        $user_id = DB::select('select id from users where email = :email', 
                    ['email' => $request->input('email')]);
        // $users = DB::table('users')->get();
        $id = [];
        foreach ($user_id as $id) {
            $id = $id->id;
        }            
        // dd($id);

        return redirect()->route('chat', ['user_id' => $id])->with('info', 'Congratulation!!!');
 
    }

    public function getLogout() {
        Auth::logout();
        return redirect()->route('welcome');
    }
}