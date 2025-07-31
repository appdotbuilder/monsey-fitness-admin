<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Membership
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $price
 * @property int $duration_months
 * @property bool $is_recurring
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClientMembership> $clientMemberships
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership query()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereDurationMonths($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereIsRecurring($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership active()
 * @method static \Database\Factories\MembershipFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Membership extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration_months',
        'is_recurring',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'is_recurring' => 'boolean',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the client memberships for this membership.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clientMemberships(): HasMany
    {
        return $this->hasMany(ClientMembership::class);
    }

    /**
     * Scope a query to only include active memberships.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}