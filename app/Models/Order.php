<?php

namespace App\Models;

use App\Enums\Currency;
use App\Enums\TradeStatus;
use App\Models\Traits\CanBeOrdered;
use App\Models\Traits\HasStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    use HasStatus;

    protected $guarded = ['id'];

    protected $casts = [
        'status' => TradeStatus::class,
        'payable_currency' => Currency::class,
    ];

    protected $relations = ['merchant'];

    public function getTimeLeft(string $created_at = null)
    {
        $created_at = $created_at ?? $this->transaction->created_at;

        $endTime = Carbon::parse($created_at)->addMinutes($this->payment_limit);

        return now()->diffInSeconds($endTime, false);
    }

    /**
     * Relationships
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
