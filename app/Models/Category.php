<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;
use App\Traits\HasCacheable;

class Category extends Model
{
    use HasTranslations;
    use HasCacheable;

    protected $table = 'vendor_category_list';
    protected $guarded = [];

    // 🔑 Required by trait
    protected function getCacheType(): string
    {
        return 'categories';
    }

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }

    public static function getNextOrder($vendorId)
    {
        return static::where('vendor_id', $vendorId)->lockForUpdate()
            ->max('orders') + 1;
    }
}
