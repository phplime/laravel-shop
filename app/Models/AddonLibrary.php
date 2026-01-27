<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;
use App\Traits\HasCacheable;

class AddonLibrary extends Model
{
    use HasTranslations, HasCacheable;

    protected $table = 'vendor_addon_library';
    protected $guarded = [];
    public $timestamps = false;

    public static function getNextOrder($vendorId)
    {
        return static::where('vendor_id', $vendorId)->lockForUpdate()
            ->max('orders') + 1;
    }

    // public function itemExtras()
    // {
    //     return $this->hasMany(ItemExtra::class, 'ex_id', 'id');
    // }

    protected function getCacheType(): string
    {
        return 'addon_library';
    }
}
