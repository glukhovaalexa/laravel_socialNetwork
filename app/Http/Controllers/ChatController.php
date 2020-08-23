<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
// use App\Contact;

class ChatController extends Controller
{
    public function getChat($user_id){
        
        $user = DB::table('users')->find($user_id);
         // $contacts = DB::table('messages')->select('user_id', 'to_user_id')->distinct()
        //                 ->where('user_id', $user->id)
        //                 ->orWhere('to_user_id', $user->id)
                        
        //                 ->get();
        $contacts = Auth::user()->friends();
        // dd($contacts);
        // dd($contacts);


        return view('profile', [
        'user' => $user,
        'contacts' => $contacts
        ]);

    }

    public function getUserChat($friend_id){
        $user_id = Auth::user()->id;
        $contacts = Auth::user()->friends();
        // dd($user_id);
      
        // $messages = DB::table('messages')->join('users', 'users.id', '=', 'messages.user_id')
        // ->where('user_id', $friend_id)
        // ->orWhere('to_user_id', $user_id)
        // ->orWhere('to_user_id', $friend_id)
        // ->orWhere('user_id', $user_id)
        // ->get();
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
        // ->where('user_id', $friend_id)
        // ->orWhere('to_user_id', $user_id)
        // ->orWhere('to_user_id', $friend_id)
        // ->orWhere('user_id', $user_id)
        // ->groupBy('created_at')->reverse()
        // $messages_from = DB::table('messages')->where('user_id', $friend_id)->orWhere('to_user_id', $user_id)->get();
        // $messages_to = DB::table('messages')->where('user_id', $user_id)->orWhere('to_user_id', $friend_id)->get();
        // $message_from_user = [];
        // $message_to_user = [];
        // foreach($messages_from as $message_from){
        //     $message_from_user = [
        //         "id" => $message_from->id,
        //         "user_id" => $message_from->user_id,
        //         "to_user_id" => $message_from->to_user_id,
        //         "message" => $message_from->message,
        //         "created_at" => $message_from->created_at,
        //         "updated_at" => $message_from->updated_at,
        //     ];
        // }
        // foreach($messages_to as $message_to){
        //     $message_to_user = [
        //         "id" => $message_to->id,
        //         "user_id" => $message_to->user_id,
        //         "to_user_id" => $message_to->to_user_id,
        //         "message" => $message_to->message,
        //         "created_at" => $message_to->created_at,
        //         "updated_at" => $message_to->updated_at,
        //     ];
        // }
        // // $messages[] = $message_to_user + $message_from_user;
        // $messages[] = array_merge($message_from_user, $message_to_user);
        // $messages = collect($messages_from, $messages_to);
        dd($messages);
       
        // dd($messages, $contacts);

        return view('chat', [
        // 'user' => $user,
        'contacts' => $contacts,
        // 'messages_from' => $messages_from,
        // 'messages_to' => $messages_to
        'messages' => $messages
        ]);
    }

}
