<?php

namespace App\Enums;

use App\Enums\Traits\HasValues;

enum Currency: string
{
    use HasValues;

    case NGN = 'nigerian-naira';
    case AWG = 'arubaly-coin';
    case USD = 'us-dollar';

    public function label(): string
    {
        return match ($this) {
            self::NGN => 'Naira',
            self::AWG => 'ARUBA FLORIN',
            self::USD => 'US Dollar',
        };
    }

    public function toString(): string
    {
        return $this->name;
    }
}
