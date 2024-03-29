<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
{
    public function rules()
    {
        return [
            'amount' => 'required',
            'description' => 'required',
            'datetime' => 'required',
        ];
    }
}
