<?php

namespace App\Models;

use App\Enums\Currency;
use App\Enums\TradeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'status' => TradeStatus::class,
        'payable_currency' => Currency::class,
    ];

    protected $relations = ['merchant'];

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
