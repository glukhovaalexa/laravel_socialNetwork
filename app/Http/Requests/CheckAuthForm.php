<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckAuthForm extends FormRequest
{

  
    public function rules()
    {
        return [
          'email' => 'required|max:255',
          'password' => 'required|min:6',
        ];
    }
}