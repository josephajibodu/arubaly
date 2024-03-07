<?php

namespace App\Models;

use App\Enums\Currency;
use App\Enums\TradeStatus;
use App\Enums\TransactionType;
use App\Models\Traits\CanBeOrdered;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;

    use CanBeOrdered;

    protected $casts = [
        'type' => TransactionType::class,
        'status' => TradeStatus::class,
        'currency' => Currency::class,
    ];

    protected $guarded = ['id'];

    /**
     * Relationships
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function conversion(): HasOne
    {
        return $this->hasOne(Conversion::class);
    }

    public function transfer(): HasOne
    {
        return $this->hasOne(Transfer::class);
    }

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }

    public function withdrawal(): HasOne
    {
        return $this->hasOne(Withdrawal::class);
    }

    /**
     * Scope a query to only include withdrawals
     */
    public function scopeWithdrawals(Builder $query): void
    {
        $query->where('type', TransactionType::WITHDRAWAL);
    }

    /**
     * Scope a query to only include transfers
     */
    public function scopeTransfers(Builder $query): void
    {
        $query->where('type', TransactionType::TRANSFER);
    }

    /**
     * Scope a query to only include buy orders
     */
    public function scopeBuyOrders(Builder $query): void
    {
        $query->where('type', TransactionType::ORDER);
    }

    /**
     * Scope a query to only include conversions
     */
    public function scopeConversions(Builder $query): void
    {
        $query->where('type', TransactionType::CONVERSION);
    }
}
