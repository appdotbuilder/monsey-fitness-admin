<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Payment
 *
 * @property int $id
 * @property int $client_id
 * @property string $amount
 * @property string $type
 * @property string $method
 * @property string $status
 * @property string|null $transaction_id
 * @property string|null $gateway
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $processed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereGateway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereProcessedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment completed()
 * @method static \Database\Factories\PaymentFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'client_id',
        'amount',
        'type',
        'method',
        'status',
        'transaction_id',
        'gateway',
        'notes',
        'processed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'processed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the client for this payment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Scope a query to only include completed payments.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}