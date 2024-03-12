<?php

namespace App\Filament\Resources\ConversionResource\Pages;

use App\Enums\TradeStatus;
use App\Filament\Resources\ConversionResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListConversions extends ListRecords
{
    protected static string $resource = ConversionResource::class;

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
