<?php

namespace App\Filament\Widgets;

use App\Models\Conversion;
use App\Models\Order;
use App\Models\Transfer;
use App\Models\User;
use App\Models\Withdrawal;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Admins', User::role('admin')->count()),

            Stat::make('Users', Number::abbreviate(User::count()))
                ->url('admin/users'),

            Stat::make('Aruba Orders', Number::abbreviate(Order::count()))
                ->description(Number::abbreviate(Order::pending()->count()). " pending")
                ->url('admin/orders'),

            Stat::make('Conversions', Number::abbreviate(Conversion::count()))
                ->description(Number::abbreviate(Conversion::pending()->count()). " pending")
                ->url('admin/conversions'),

            Stat::make('Transfers', Number::abbreviate(Transfer::count()))
                ->description(Number::abbreviate(Transfer::pending()->count()). " pending")
                ->url('admin/transfers'),

            Stat::make('Withdrawals', Number::abbreviate(Withdrawal::count()))
                ->description(Number::abbreviate(Withdrawal::pending()->count()). " pending")
                ->url('admin/withdrawals'),
        ];
    }
}
