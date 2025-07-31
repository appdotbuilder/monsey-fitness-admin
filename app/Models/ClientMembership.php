<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ClientMembership
 *
 * @property int $id
 * @property int $client_id
 * @property int $membership_id
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property string $amount_paid
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @property-read \App\Models\Membership $membership
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|ClientMembership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientMembership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientMembership query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientMembership whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientMembership whereMembershipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientMembership whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientMembership whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientMembership whereAmountPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientMembership whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientMembership whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientMembership whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientMembership whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientMembership active()
 * @method static \Database\Factories\ClientMembershipFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class ClientMembership extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'client_id',
        'membership_id',
        'start_date',
        'end_date',
        'amount_paid',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'amount_paid' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the client that owns the membership.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the membership.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }

    /**
     * Scope a query to only include active memberships.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}