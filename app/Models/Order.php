<?php

namespace App\Models;

use App\Models\OrderProduct;
use App\Models\Shipping;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_no',
        'subtotal',
        'total',
        'payment_provider',
        'payment_id',
        'shipping_id',
        'shipping_address_id',
        'billing_address_id',
        'payment_status',
        'payment_method',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Shipping::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('id', 'product_id', 'user_id', 'price', 'quantity')
            ->withTimestamps();
    }

    public function order_products(): HasMany
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
}
