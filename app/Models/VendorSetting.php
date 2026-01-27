<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class VendorSetting extends Model
{
    protected $table = 'vendor_settings';
 
    protected $fillable = [
        'vendor_id',
        'user_id',
        'key',
        'value',
        'status',
        'is_default'
    ];
 
    public $timestamps = false;
}
