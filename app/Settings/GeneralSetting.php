<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSetting extends Settings
{
    public string $site_name;

    public float $awg_rate;

    public float $usd_rate_official;

    public float $usd_rate_parallel;

    public float $exchange_fee_percentage;

    public float $payment_limit;

    public int $aruba_to_usd_processing_time;

    public int $usd_to_naira_processing_time_official;

    public int $usd_to_naira_processing_time_parallel_market;

    public string $whatsapp_group_link;

    public static function group(): string
    {
        return 'general';
    }
}
