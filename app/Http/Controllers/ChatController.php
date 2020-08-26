<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Message;
use Illuminate\Http\Request;
use App\Events\NewMessage;

class ChatController extends Controller
{
    public function getChat($user_id, Request $request){
        dd($request);
        $user = DB::table('users')->find($user_id);

        $contacts = Auth::user()->friends();
        $search_contact = $request->input('search_contact');
        // dd($search_contact);
        if($search_contact){
    
            if(stristr($search_contact, '38') === FALSE){
                $search_contact = '38'. $search_contact;
            }
            if($search_contact !== $user->phone){
            
            $search_contact = DB::table('users')
            ->where('phone', "$search_contact")->get();
        // dd($search_contact);
            }else{
                $search_contact = '';
            }
            
        }
        // dd($user, $contacts, $search_contact);
        return view('profile', [
        'user' => $user,
        'contacts' => $contacts,
        'search_contact' => $search_contact
        ]);
        // return json_encode(array('success' => 1));

    }


    public function getUserChat($friend_id, $search_contact = ''){
        // dd($friend_id);

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
        'search_contact' => $search_contact,
        'friend_id' => $friend_id,
        'last_msg' => $last_msg
        ]);

        //// вывод для vue в Json
        // return response()->toArray()->json([
        //     'contacts' => $contacts,
        //     'messages' => $messages,
        //     'friends' => $friends,
        //     'last_msg' => $last_msg
        // ]);

    }

    public function sendMsg(Request $request){

            $messages = new Message;
            $messages->user_id = $request->input('user_id');
            $messages->to_user_id = $request->input('friend_id');
            $messages->message = $request->input('message');
            $messages->save();

            event( new NewMessage($request->input('friend_id'), $messages));

            return redirect()->route('chat.user', ['friend_id' => $request->input('friend_id')]);


            // вывод для vue в Json
            // $messagesSend = Message::create([
            //     'user_id' => $request->input('user_id'),
            //     'to_user_id' => $request->input('friend_id'),
            //     'message' => $request->input('message')
            // ]);
                
            // return $messagesSend->toArray()->json();

    }

}