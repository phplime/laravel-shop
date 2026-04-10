<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'customer_list';

    protected $fillable = [
        'user_id',
        'vendor_id',
        'name',
        'email',
        'phone',
        'dial_code',
        'password',
        'status',
        'wallet_bal',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'status' => 'integer',
        'wallet_bal' => 'float',
    ];
}
