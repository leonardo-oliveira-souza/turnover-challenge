<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    protected $fillable = [
        'account_id',
        'description',
        'ammount',
        'status',
        'image_path',
    ];
}
