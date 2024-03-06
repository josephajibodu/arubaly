<?php

namespace App\Enums;

use App\Enums\Traits\HasValues;

enum TransactionType: string
{
    use HasValues;

    case CONVERSION = 'conversion';
    case WITHDRAWAL = 'withdrawal';
    case TRANSFER = 'transfer';
    case ORDER = 'order';

    public function label(): string
    {
        return match ($this) {
            self::CONVERSION => 'Conversion',
            self::WITHDRAWAL => 'Withdrawal',
            self::TRANSFER => 'Transfer',
            self::ORDER => 'US Dollar',
        };
    }

    public function toString(): string
    {
        return $this->name;
    }
}
