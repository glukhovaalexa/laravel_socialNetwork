<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function getChat($user_id){
        // dd($user_id);
        
        $user = $user = DB::table('users')->find($user_id);
        // dd($user);


        return view('chat', ['user' => $user]);

    }


}
