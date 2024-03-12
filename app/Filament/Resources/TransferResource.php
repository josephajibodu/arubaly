<?php

namespace App\Filament\Resources;

use App\Enums\Currency;
use App\Enums\TradeStatus;
use App\Filament\Resources\TransferResource\Pages;
use App\Filament\Resources\TransferResource\RelationManagers;
use App\Models\Transfer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransferResource extends Resource
{
    protected static ?string $model = Transfer::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->orderByDesc('created_at');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Transaction Info')
                    ->schema([
                        TextEntry::make('transaction.reference')
                            ->label('Reference'),

                        TextEntry::make('transaction.status')
                            ->label('Status')
                            ->badge()
                            ->color(fn(TradeStatus $state) => match ($state) {
                                TradeStatus::PENDING => 'gray',
                                TradeStatus::PAYMENT_SENT => 'info',
                                TradeStatus::PAYMENT_CONFIRMED, TradeStatus::COMPLETED => 'success',
                                TradeStatus::PAYMENT_UNCONFIRMED => 'warning',
                                TradeStatus::CANCELLED => 'danger',
                            }),

                        TextEntry::make('transaction.amount')
                            ->label('Amount')
                            ->money(fn(Transfer $record) => match ($record->transaction->currency) {
                                Currency::AWG => 'AWG',
                                Currency::USD => 'USD',
                                Currency::NGN => 'NGN',
                            }, 100),

                        TextEntry::make('transaction.description')
                            ->label('Description'),

                    ])->columns(2),

                Section::make('More Details')
                    ->schema([
                        TextEntry::make('transaction.user.username')
                            ->label('From'),

                        TextEntry::make('recipient.username')
                            ->label('To'),
                    ])->columns(2),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('transaction_id')
                    ->relationship('transaction', 'id')
                    ->required(),

                Forms\Components\Select::make('recipient_id')
                    ->relationship('recipient', 'id')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaction.reference'),
                Tables\Columns\TextColumn::make('transaction.amount')
                    ->label('Amount')
                    ->money(fn(Transfer $record) => match ($record->transaction->currency) {
                        Currency::AWG => 'AWG',
                        Currency::USD => 'USD',
                        Currency::NGN => 'NGN',
                    }, 100),

                Tables\Columns\TextColumn::make('transaction.user.username')
                    ->label('From'),

                Tables\Columns\TextColumn::make('recipient.username')
                    ->label('To'),

                Tables\Columns\TextColumn::make('transaction.status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(TradeStatus $state) => match ($state) {
                        TradeStatus::PENDING => 'gray',
                        TradeStatus::PAYMENT_SENT => 'info',
                        TradeStatus::PAYMENT_CONFIRMED, TradeStatus::COMPLETED => 'success',
                        TradeStatus::PAYMENT_UNCONFIRMED => 'warning',
                        TradeStatus::CANCELLED => 'danger',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->since(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransfers::route('/'),
            'create' => Pages\CreateTransfer::route('/create'),
//            'edit' => Pages\EditTransfer::route('/{record}/edit'),
        ];
    }
}
