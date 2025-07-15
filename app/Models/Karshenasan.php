<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Karshenasan extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'lname',
        'username',
        'password',
        'b_date',
        'level',
        'region',
    ];

    protected $hidden = [
        'password',
    ];
}
