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
            'image_path' => $this->image_path,
            'datetime' => $this->created_at->format('m/d/Y, H:i:s'),
        ];
    }
}
