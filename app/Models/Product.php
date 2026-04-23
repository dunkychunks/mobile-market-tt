<?php

namespace App\Models;

use App\Helpers\ProductCollectionHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array<int, \Illuminate\Database\Eloquent\Model>  $models
     * @return \Illuminate\Database\Eloquent\Collection<int, \Illuminate\Database\Eloquent\Model>
     */
    public function newCollection(array $models = []): Collection
    {
        return new ProductCollectionHelper($models);
    }

    /**
     *  =============== RELATIONSHIPS  ===============
     */

    public function groupPrices(): HasMany
    {
        return $this->hasMany(ProductGroupPrice::class);
    }

    /**
     *  =============== SCOPES  ===============
     */

    /*
     * scopeWithPrices LEFT JOINs the product_group_prices table for the user's
     * price group(s). The COALESCE picks the group-specific price when one exists,
     * falling back to the base product price for users with no special group or
     * products with no override set.
     *
     * Controllers call:  Product::withPrices($user->getGroups())->...
     * Product::getPrice() then returns $this->effective_price ?? $this->price.
     */
    public function scopeWithPrices(Builder $query, array $group_ids = [1])
    {
        // Use the first group ID (users currently belong to one group via their tier)
        $group_id = $group_ids[0] ?? 1;

        $query->addSelect([
            'products.*',
            \DB::raw("COALESCE(
                (SELECT pgp.price FROM product_group_prices pgp
                 WHERE pgp.product_id = products.id AND pgp.group_id = {$group_id}
                 LIMIT 1),
                products.price
            ) as effective_price"),
        ]);
    }

    public function scopeSingleProduct(Builder $query, int $id)
    {
        $query->where('products.id', $id);
    }




    /**
     *  =============== FUNCTIONS  ===============
     */
    public function getImage()
    {
        return asset('storage' . $this->image_path . $this->image_name);
    }


    /*
     * Returns the effective price for the current user's group.
     * effective_price is populated by scopeWithPrices via a subquery COALESCE.
     * Falls back to the base price when no group override is set.
     */
    public function getPrice()
    {
        return $this->effective_price ?? $this->price;
    }

    public function getStockPrice()
    {
        return $this->price;
    }


    public function getCartQuantityPrice()
    {
        return $this->getPrice() * $this->pivot->quantity;
    }

    public function getLink()
    {
        return route('shop.details', ['id' => $this->id]);
    }
}
