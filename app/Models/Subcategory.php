<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class SubCategory extends Model
{
    use HasTranslations;

    protected $table = 'vendor_subcategory_list';
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public static function getNextOrder($vendorId)
    {
        return static::where('vendor_id', $vendorId)->lockForUpdate()
            ->max('orders') + 1;
    }
}
