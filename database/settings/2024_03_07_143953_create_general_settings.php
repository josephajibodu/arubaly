<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Arubaly');
        $this->migrator->add('general.awg_rate', 478);
        $this->migrator->add('general.usd_rate_official', 1500);
        $this->migrator->add('general.usd_rate_parallel', 1600);
        $this->migrator->add('general.exchange_fee_percentage', 3);
        $this->migrator->add('general.payment_limit', 12);
        $this->migrator->add('general.aruba_to_usd_processing_time', 240);
        $this->migrator->add('general.usd_to_naira_processing_time_official', 240);
        $this->migrator->add('general.usd_to_naira_processing_time_parallel_market', 240);
    }
};
