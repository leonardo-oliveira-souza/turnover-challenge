<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckRequest extends FormRequest
{
    public function rules()
    {
        return [
            'amount' => 'required',
            'description' => 'required',
            'check' => 'required|file',
        ];
    }
}
