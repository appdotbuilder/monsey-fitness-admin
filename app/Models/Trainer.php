<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Trainer
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $phone
 * @property string|null $specialties
 * @property string $hourly_rate
 * @property string $commission_rate
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $full_name
 * @property array $specialties_array
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Session> $sessions
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereSpecialties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereHourlyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereCommissionRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer active()
 * @method static \Database\Factories\TrainerFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Trainer extends Model
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
        'specialties',
        'hourly_rate',
        'commission_rate',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'specialties' => 'array',
        'hourly_rate' => 'decimal:2',
        'commission_rate' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the trainer's full name.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get the trainer's specialties as an array.
     *
     * @return array
     */
    public function getSpecialtiesArrayAttribute(): array
    {
        return $this->specialties ?? [];
    }

    /**
     * Get the trainer's sessions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

    /**
     * Scope a query to only include active trainers.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}