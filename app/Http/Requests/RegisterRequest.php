<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'username' => 'required|max:255|unique:App\Models\User,username',
            'email' => 'required|max:255|unique:App\Models\User,email',
            'password' => 'required|max:255|min:6',
        ];
    }
}
