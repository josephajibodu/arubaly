<?php

namespace App\Enums;

use App\Enums\Traits\HasValues;

enum TradeStatus: string
{
    use HasValues;

    case PENDING = 'pending';
    case PAYMENT_SENT = 'payment_sent';
    case PAYMENT_CONFIRMED = 'payment_confirmed';
    case PAYMENT_UNCONFIRMED = 'payment_unconfirmed';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::PAYMENT_SENT => 'Payment Sent',
            self::PAYMENT_CONFIRMED => 'Payment Confirmed',
            self::PAYMENT_UNCONFIRMED => 'Payment Unconfirmed',
            self::CANCELLED => 'Cancelled',
            self::COMPLETED => 'Completed',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'orange',
            self::PAYMENT_SENT => 'blue',
            self::PAYMENT_CONFIRMED => '#485e52',
            self::PAYMENT_UNCONFIRMED => 'gray',
            self::CANCELLED => 'red',
            self::COMPLETED => 'green',
        };
    }

}
// pending, payment_sent, payment_confirmed, cancelled, completed
