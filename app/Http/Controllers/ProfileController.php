<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($user_id){
        return view('profile-settings', [
            'user_id' => $user_id
            ]);
    }

    public function addChanges($user_id, Request $request){
        // dd($request->file('image'));
        
        if($request->file('image')){
            $path = $request->file('image')->store("avatars", 'public');
        }

        if(empty($request->input('name')) && $request->input('country') && $request->input('image')){

            DB::table('users')->where('id', $user_id)
                ->update(
                ['country' => $request->input('country'), 
                'avatar_path' => "$path"],
                );
        }
        if($request->input('name') && empty($request->input('country')) && empty($request->input('image'))){
        
            DB::table('users')->where('id', $user_id)
                ->update(
                ['name' => $request->input('name')],
                );
        }
        if($request->input('country') && empty($request->input('name')) && empty($request->input('image'))){

            DB::table('users')->where('id', $user_id)
                ->update(
                ['country' => $request->input('country')],
                );
        }
        if(empty($request->input('country')) && $request->input('name') && $request->input('image')){

            DB::table('users')->where('id', $user_id)
                ->update(
                ['name' => $request->input('name'), 
                'avatar_path' => "$path"],
                );
        }
        if(empty($request->input('country')) && empty($request->input('name')) && $request->input('image')){

            DB::table('users')->where('id', $user_id)
                ->update(
                ['avatar_path' => "$path"],
                );
        }
        if(empty($request->input('country')) && empty($request->input('name')) && empty($request->input('image'))){
            return redirect()->route('profile.settings', ['user_id' => $user_id])->with('info', 'You didn`t add any changes');
        }
        if($request->input('country') && $request->input('name') && $request->input('image')){

            DB::table('users')->where('id', $user_id)
                ->update(
                ['name' => $request->input('name'), 
                'country' => $request->input('country'), 
                'avatar_path' => "$path"],
                );
        }
        
        return redirect()->route('profile.settings', ['user_id' => $user_id])->with('info', 'Congrats! We add all your changes');;
        
    }

}