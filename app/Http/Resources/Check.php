<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Check extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'account_id' => $this->account_id,
            'description' => $this->description,
            'amount' => number_format($this->amount, 2),
            'status' => $this->status,
            'encoded_image' => $this->encoded_image,
            'datetime' => $this->created_at->format('m/d/Y, H:i:s'),
            'account' => Account::make($this->whenLoaded(('account'))),
        ];
    }
}
