<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckRegisterForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'phone' => 'required|max:255|min:10',
          'userName' => 'required|max:255|min:2',
          'email' => 'required|unique:users|max:255',
          'password' => 'required|min:6',
          'userCountry' => 'required|max:255',
        ];
    }
}
