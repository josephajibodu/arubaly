<?php

namespace App\Models\Traits;

use App\Enums\TradeStatus;
use Illuminate\Database\Eloquent\Builder;

trait HasStatus
{
    /**
     * Scope a query to only include buy orders
     */
    public function scopePending(Builder $query): void
    {
        $query->whereHas('transaction', fn($q) => $q->where('status', TradeStatus::PENDING));
    }
}
