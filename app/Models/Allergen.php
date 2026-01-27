<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class Allergen extends Model
{
    use HasTranslations;

    protected $table = 'vendor_allergen_list';
    protected $guarded = [];

    public static function getNextOrder($vendorId)
    {
        return static::where('vendor_id', $vendorId)->lockForUpdate()
            ->max('orders') + 1;
    }
}
