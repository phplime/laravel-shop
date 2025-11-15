<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Package extends Model
{
    protected $table = 'package_list';

    protected $guarded = [];
    // protected $fillable = [
    //     'package_name',
    //     'slug',
    //     'package_type',
    //     'price',
    //     'previous_price',
    //     'duration',
    //     'store_limit',
    //     'is_private',
    //     'module_ids',
    // ];

    // protected $casts = [
    //     'price' => 'decimal:2',
    //     'previous_price' => 'decimal:2',
    //     'is_private' => 'boolean',
    //     'module_ids' => 'array', // Automatically handle JSON encode/decode
    // ];

    /**
     * Get features for this package (using DB query)
     */
    // public function getFeatures()
    // {
    //     return DB::table('active_package_features')
    //         ->join('feature_list', 'features.id', '=', 'active_package_features.feature_id')
    //         ->where('active_package_features.package_id', $this->id)
    //         ->select('features.*')
    //         ->get();
    // }

    /**
     * Get feature IDs for this package
     */
    // public function getFeatureIds()
    // {
    //     return DB::table('active_package_features')
    //         ->where('package_id', $this->id)
    //         ->pluck('feature_id')
    //         ->toArray();
    // }
}
