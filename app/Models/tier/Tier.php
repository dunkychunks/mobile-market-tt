<?php

namespace App\Models\tier;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tier extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'spending_range',
        'group_id'
    ];

    /**
     * Get the group that owns the Tier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
