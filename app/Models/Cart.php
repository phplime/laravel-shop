<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'vendor_cart_items';
    protected $fillable = [
        'user_id',
        'owner_id',
        'customer_id',
        'session_id',
        'vendor_id',
        'product_id',
        'variant_id',
        'quantity',
        'price',
        'options',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function vendor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function getSubtotalAttribute(): float
    {
        return (float) $this->price * $this->quantity;
    }
}
