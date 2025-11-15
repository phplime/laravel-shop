<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    protected $table = 'media_files';
    protected $guarded = [];
    public $timestamps = false; // Disable automatic timestamps



    protected $casts = [
        'created_at' => 'datetime',
    ];
}
