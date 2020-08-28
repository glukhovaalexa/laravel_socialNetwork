<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests\CheckRegisterForm;
use App\Http\Requests\CheckAuthForm;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{

    // public $msg_number;

    //Register
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
        
       
        $user_id = DB::select('select id from users where email = :email', 
                    ['email' => $request->input('email')]);
        // $user_phone = DB::select('select phone from users where email = :email', 
        //             ['email' => $request->input('email')]);
        // $phone = '';            
        // foreach($user_phone as $phone){
        //     $phone = $phone->phone;
        // }            
        // $this->sendMessage($user_id, $phone);
        $id = [];
        foreach ($user_id as $id) {
            $id = $id->id;
        } 
        $user = Auth::user();
        // return redirect()->route('register.prove');
        return redirect()->route('welcome')->with('info', 'You are succesfully registred, please login');

    }

    // public function sendMessage($user_id, $phone){
    //     $basic  = new \Nexmo\Client\Credentials\Basic('3ecbaf52', 'JA4GFj4Yf7zvyKHP');
    //     $client = new \Nexmo\Client($basic);
    //     $this->msg_number = rand(1000, 9999);
    // }

    // public function getMsgNumber(){
    //     return $this->msg_number;
    // }

    // public function getSignupProve() {
    //     return view('register_prove');
    // }

    // public function postSignupProve(Request $request) {
    //     dd($this->msg_number);
    //     if($request->input('code') === $this->msg_number){
    //         // return redirect()->route('chat', ['user_id' => $id])->with('info', 'Congratulation!!!');
    //         echo 'yue!!!!';
    //     }else{
            
    //         return redirect()->route('register.prove');
    //     }
    // }

    //Authentify
    public function postSignin(CheckAuthForm $request){
        
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

        return redirect()->route('chat', ['user_id' => $id]);
 
    }

    public function getLogout() {
        Cache::forget('user-is-online-' . Auth::user()->id);
        Auth::logout();
        return redirect()->route('welcome');
    }

}