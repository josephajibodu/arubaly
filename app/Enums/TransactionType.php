<?php

namespace App\Enums;

enum TransactionType: string
{
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
