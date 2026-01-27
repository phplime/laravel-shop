<?php

namespace App\Models;

use App\Models\ExtraTitleList;
use App\Models\AddonLibrary;
use Illuminate\Database\Eloquent\Model;

class ItemExtraList extends Model
{
    protected $table = 'item_extra_list';
    protected $guarded = [];
    public $timestamps = false; // Assuming no timestamps based on usage, but can verify later.

 

    public function extraTitle()
    {
        return $this->belongsTo(ExtraTitleList::class, 'extra_title_id', 'id');
    }

    public function addonLibrary()
    {
        return $this->belongsTo(AddonLibrary::class, 'extra_id', 'id');
    }

 
}
