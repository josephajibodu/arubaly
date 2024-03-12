<?php

namespace App\Models;

use App\Enums\Currency;
use App\Models\Traits\HasStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conversion extends Model
{
    use HasFactory;

    use HasStatus;

    protected $guarded = ['id'];

    protected $casts = [
        'to_currency' => Currency::class
    ];

    public function getTimeLeft(string $created_at = null)
    {
        $created_at = $created_at ?? $this->transaction->created_at;

        $endTime = Carbon::parse($created_at)->addMinutes($this->processing_time);

        return now()->diffInSeconds($endTime, false);
    }

    /**
     * Relationships
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
