<?php

namespace App\Enums;

enum Currency: string
{
    case NGN = 'nigerian-naira';
    case AWG = 'arubaly-coin';
    case USD = 'us-dollar';

    public function label(): string
    {
        return match ($this) {
            self::NGN => "Naira",
            self::AWG => "ARUBA FLORIN",
            self::USD => "US Dollar",
        };
    }

    public function toString(): string
    {
        return $this->name;
    }
}
