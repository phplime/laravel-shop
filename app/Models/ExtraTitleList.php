<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class ExtraTitleList extends Model
{
    use HasTranslations;

    protected $table = 'vendor_extra_title_list';
    protected $guarded = [];

    public function extraList()
    {
        return $this->hasMany(ItemExtraList::class, 'extra_title_id');
    }



  
}
