<?php

namespace App\Filament\Resources\TransferResource\Pages;

use App\Enums\TradeStatus;
use App\Filament\Resources\TransferResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTransfers extends ListRecords
{
    protected static string $resource = TransferResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'pending' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('transaction', function ($q) {
                    $q->where('status', TradeStatus::PENDING);
                })),
            'completed' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('transaction', function ($q) {
                    $q->where('status', TradeStatus::COMPLETED);
                })),
        ];
    }
}
