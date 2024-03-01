<?php

namespace App\Enums;

enum TradeStatus: string
{
    case PENDING = 'pending';
    case PAYMENT_SENT = 'payment_sent';
    case PAYMENT_CONFIRMED = 'payment_confirmed';
    case PAYMENT_UNCONFIRMED = 'payment_unconfirmed';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';
}
// pending, payment_sent, payment_confirmed, cancelled, completed