<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Message;
use Illuminate\Http\Request;
// use Illuminate\Support\Collection;

class ChatController extends Controller
{
    public function getChat($user_id){
        
        $user = DB::table('users')->find($user_id);
        // dd(Auth::user());
        $contacts = Auth::user()->friends();

        return view('profile', [
        'user' => $user,
        'contacts' => $contacts
        ]);

    }

    public function getUserChat($friend_id){

        $user_id = Auth::user()->id;
        $contacts = Auth::user()->friends();
        $friends = $contacts->where('id', $friend_id);
        // dd($friends);
        $messages = DB::table('messages')->leftJoin('users as user', 'user.id', '=', 'messages.user_id')->leftJoin('users as friend', 'friend.id', '=', 'messages.to_user_id')->select('user.id as user_id', 'user.name as user_name', 'friend.id as friend_id', 'friend.name as friend_name', 'messages.message as message', 'messages.created_at as created_at')
        ->where([
            ['user_id', "$user_id"],
            ['to_user_id', $friend_id],
        ])
        ->orWhere([
            ['user_id', $friend_id],
            ['to_user_id', $user_id],
        ])
        ->get();

        $last_msg = DB::table('messages')
        ->where([
            ['user_id', "$user_id"],
            ['to_user_id', $friend_id],
        ])
        ->orWhere([
            ['user_id', $friend_id],
            ['to_user_id', $user_id],
        ])->latest()->first();

        return view('chat', [
        'contacts' => $contacts,
        'messages' => $messages,
        'friends' => $friends,
        'last_msg' => $last_msg
        ]);
    }

    public function sendMsg(Request $request){

            $messages = new Message;
            $messages->user_id = $request->input('user_id');
            $messages->to_user_id = $request->input('friend_id');
            $messages->message = $request->input('message');
            $messages->save();

            return redirect()->route('chat.user', ['friend_id' => $request->input('friend_id')]);
     
    }

}
