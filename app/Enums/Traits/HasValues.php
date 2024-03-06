<?php

namespace App\Enums\Traits;

trait HasValues
{
    public static function values()
    {
        return collect(self::cases())->map(fn ($status) => $status->value);
    }
}
