<?php

namespace App\Http\Controllers;

use DB;
// use Auth;
use App\User;
use App\Message;
use App\Friend;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Events\NewMessage;

class ChatController extends Controller
{

    public function getChat($user_id, Request $request, $search_contact = []){
        $_SESSION = '';
        $user = DB::table('users')->find($user_id);

        $contacts = Auth::user()->friends();

        $search_contact = $request->input('search_contact');

        if($search_contact){
            if(stristr($search_contact, '38') === FALSE){
                $search_contact = '38'. $search_contact;
    
            }
            if($search_contact !== $user->phone){
            
            $search_contact = DB::table('users')
            ->where('phone', "$search_contact")->get();
            }
        }else{
            $search_contact = [];
        }
        return view('profile', [
        'user' => $user,
        'contacts' => $contacts,
        'search_contact' => $search_contact
        ]);

    }


    public function getUserChat($friend_id, $search_contact = ''){
        $user_id = Auth::user()->id;

        $contacts = Auth::user()->friends();
        $friends = $contacts->where('id', $friend_id);
        if(!$friends->count()){
            $posibleFriend = DB::table('users')->where('id', $friend_id)->get();
        }else{
            $posibleFriend = '';
        }

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

        $last_msg = [];
        foreach($contacts as $contact){
            $msg = DB::table('messages')->select('message')->where([
                ['user_id', "$user_id"],
                ['to_user_id', $contact->id],
            ])->orWhere([
                ['user_id', $contact->id],
                ['to_user_id', $user_id],
            ])->latest()->first();

            $last_msg = $msg; 
        }

        return view('chat', [
        'contacts' => $contacts,
        'messages' => $messages,
        'friends' => $friends,
        'friend_id' => $friend_id,
        'search_contact' => $search_contact,
        'posibleFriend' => $posibleFriend,
        'last_msg' => array($last_msg)
        ]);

    }

    public function sendMsg(Request $request){

            $messages = new Message;
            $messages->user_id = $request->input('user_id');
            $messages->to_user_id = $request->input('friend_id');
            $messages->message = $request->input('message');
            $messages->save();

            event( new NewMessage($request->input('friend_id'), $messages));
            $contacts = Auth::user()->friends();
            $friends = $contacts->where('id', $request->input('friend_id'));
           
            if(!$friends->count()){

                $this->makeFriends($request->input('user_id'), $request->input('friend_id'));
            }
            return redirect()->route('chat.user', ['friend_id' => $request->input('friend_id')]);

    }

    public function makeFriends($user_id, $friend_id){
        Friend::create([
            'user_id' => $user_id,
            'friend_id' => $friend_id,
            'accepted' => 1
           ]);
        return true;
    }

}