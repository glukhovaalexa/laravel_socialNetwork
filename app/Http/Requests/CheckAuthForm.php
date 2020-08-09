<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckAuthForm extends FormRequest
{

  
    public function rules()
    {
        return [
          'userName' => 'required|max:255|min:2',
          'email' => 'required|unique:users|max:255',
          'password' => 'required|min:6',
          'userCountry' => 'required|max:255',
        ];
    }
}