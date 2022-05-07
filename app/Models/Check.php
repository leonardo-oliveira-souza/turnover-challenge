<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    protected $fillable = [
        'account_id',
        'description',
        'amount',
        'status',
        'image_path',
    ];
}
