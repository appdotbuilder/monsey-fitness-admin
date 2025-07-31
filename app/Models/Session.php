<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Session
 *
 * @property int $id
 * @property int $client_id
 * @property int $trainer_id
 * @property string $type
 * @property string $title
 * @property string|null $description
 * @property \Illuminate\Support\Carbon $scheduled_at
 * @property int $duration_minutes
 * @property string $price
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @property-read \App\Models\Trainer $trainer
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Session newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Session newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Session query()
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereTrainerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereScheduledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereDurationMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session scheduled()
 * @method static \Database\Factories\SessionFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Session extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'client_id',
        'trainer_id',
        'type',
        'title',
        'description',
        'scheduled_at',
        'duration_minutes',
        'price',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'scheduled_at' => 'datetime',
        'price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the client for this session.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the trainer for this session.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trainer(): BelongsTo
    {
        return $this->belongsTo(Trainer::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fitness_sessions';

    /**
     * Scope a query to only include scheduled sessions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }
}