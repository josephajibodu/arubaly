<?php

namespace App\Models\Traits;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Builder;

trait CanBeOrdered
{
    /**
     * Scope a query to only include buy orders
     */
    public function scopeDesc(Builder $query): void
    {
        $query->orderBy('created_at', 'desc');
    }
}
