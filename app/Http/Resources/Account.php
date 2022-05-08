<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Account extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_formatted' => str_pad($this->id, 5, '0', STR_PAD_LEFT),
            'user_id' => $this->user_id,
            'balance' => number_format($this->balance, 2),
            'user' => User::make($this->whenLoaded('user')),
        ];
    }
}
