<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTypeConfig extends Model
{
    protected $table = 'vendor_order_type_config';
    protected $guarded = [];

    protected $casts = [
        'tips_enabled' => 'boolean',
        'status' => 'boolean',
        'is_admin_enabled' => 'boolean',
    ];
}
