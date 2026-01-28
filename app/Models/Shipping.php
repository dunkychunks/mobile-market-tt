<?php

namespace App\Models;

use App\Models\Group;
use App\Models\ShippingOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Shipping extends Model
{
    use HasFactory;

    protected $table = 'shipping';

    protected $guarded = [];


    /**
     * The groups that belong to the Shipping
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'shipping_options')
            ->withPivot('id', 'status')
            ->withTimestamps()
        ;
    }


    /**
     * Get all of the shipping_options for the Shipping
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shipping_options(): HasMany
    {
        return $this->hasMany(ShippingOption::class, 'shipping_id', 'id');
    }
}
