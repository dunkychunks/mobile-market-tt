<?php

namespace App\Models;

use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * This ensures data integrity by defining exactly which database columns
     * the controller is allowed to populate during checkout.
     */
    protected $fillable = [
        'user_id',
        'order_no',
        'subtotal',
        'total',
        'payment_provider',
        'payment_id',         // Stores the secure Stripe Session ID
        'shipping_id',
        'shipping_address_id',
        'billing_address_id',
        'payment_status',     // Tracks the lifecycle from 'unpaid' to 'paid'
    ];

    /**
     * Establishes the Many-to-Many relationship between Orders and Products.
     * * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('id', 'product_id', 'user_id', 'price', 'quantity')
            ->withTimestamps();
    }

    /**
     * Defines the One-to-Many relationship for tracking individual order line items.
     * * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_products(): HasMany
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
}
