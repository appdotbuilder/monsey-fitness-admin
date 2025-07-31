<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Client
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $phone
 * @property \Illuminate\Support\Carbon|null $date_of_birth
 * @property string|null $gender
 * @property string|null $address
 * @property string|null $emergency_contact
 * @property string|null $medical_notes
 * @property string $status
 * @property string $outstanding_balance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $full_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClientMembership> $memberships
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Session> $sessions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $payments
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEmergencyContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereMedicalNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereOutstandingBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client active()
 * @method static \Database\Factories\ClientFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'emergency_contact',
        'medical_notes',
        'status',
        'outstanding_balance',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date',
        'outstanding_balance' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the client's full name.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get the client's memberships.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function memberships(): HasMany
    {
        return $this->hasMany(ClientMembership::class);
    }

    /**
     * Get the client's sessions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

    /**
     * Get the client's payments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Scope a query to only include active clients.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}