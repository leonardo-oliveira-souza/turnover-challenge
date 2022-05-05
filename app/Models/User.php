<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'admin',
    ];

    protected $attributes = [
        'admin' => false,
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'admin' => 'boolean',
    ];
}
