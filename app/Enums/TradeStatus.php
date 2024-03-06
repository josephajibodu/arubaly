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

}
// pending, payment_sent, payment_confirmed, cancelled, completed
