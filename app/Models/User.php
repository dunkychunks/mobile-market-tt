<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Panel;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser; // Addition for Filament
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;      // Added
use Illuminate\Database\Eloquent\Relations\BelongsTo;    // Added
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements FilamentUser // Addition: Implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /**
     * =============== RELATIONSHIPS  ===============
     */
    /**
     * The products that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'cart', 'user_id', 'product_id')
            ->withPivot('id', 'quantity')
            ->withTimestamps();
    }

        /**
     * The tier the user belongs to.
     */
    public function tier(): BelongsTo
    {
        return $this->belongsTo(Tier::class, 'tier_id');
    }

    /**
     * Get all of the orders for the User.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }




    /**
     * =============== SCOPES  ===============
     */


    /**
     * =============== FUNCTIONS  ===============
     */

    public function getGroups(): array
    {
        $group_ids = [$this->tier->id];

        return $group_ids;
    }

    /**
     * Addition: This function grants access to the Filament dashboard.
     * It fulfills the "Administrator" use case for managing the catalogue[cite: 33].
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // For testing/class purposes, return true so any logged-in user can enter.
        return true;
    }
}
