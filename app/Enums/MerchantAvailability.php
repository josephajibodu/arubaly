<?php

namespace App\Enums;

enum MerchantAvailability: string
{
    case AVAILABLE = 'available';
    case SOLDOUT = 'sold-out';

    public function label(): string
    {
        return match ($this) {
            self::AVAILABLE => 'Available',
            self::SOLDOUT => 'Sold Out',
        };
    }

    public function toString(): string
    {
        return $this->name;
    }
}