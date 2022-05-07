<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Transaction extends JsonResource
{
    public function toArray($request)
    {
        return [
            'account_id' => $this->account_id,
            'description' => $this->description,
            'type' => $this->type,
            'amount' => number_format($this->amount, 2),
            'datetime' => $this->datetime->format('m/d/Y, H:i:s'),
        ];
    }
}
