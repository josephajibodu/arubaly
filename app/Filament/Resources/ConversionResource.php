<?php

namespace App\Filament\Resources;

use App\Enums\Currency;
use App\Enums\TradeStatus;
use App\Filament\Resources\ConversionResource\Pages;
use App\Filament\Resources\ConversionResource\RelationManagers;
use App\Models\Conversion;
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

class ConversionResource extends Resource
{
    protected static ?string $model = Conversion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                            ->money(fn(Conversion $record) => match ($record->transaction->currency) {
                                Currency::AWG => 'AWG',
                                Currency::USD => 'USD',
                                Currency::NGN => 'NGN',
                            }, 100),

                        TextEntry::make('transaction.description')
                            ->label('Description'),

                    ])->columns(2),

                Section::make('More Details')
                    ->schema([
                        TextEntry::make('transaction.amount')
                            ->label('Convert')
                            ->money(fn(Conversion $record) => match ($record->transaction->currency) {
                                Currency::AWG => 'AWG',
                                Currency::USD => 'USD',
                                Currency::NGN => 'NGN',
                            }, 100),

                        TextEntry::make('to_amount')
                            ->label('To')
                            ->money(fn(Conversion $record) => match ($record->to_currency) {
                                Currency::AWG => 'AWG',
                                Currency::USD => 'USD',
                                Currency::NGN => 'NGN',
                            }, 100),

                        TextEntry::make('exchange_fee')
                            ->money(fn(Conversion $record) => match ($record->to_currency) {
                                Currency::AWG => 'AWG',
                                Currency::USD => 'USD',
                                Currency::NGN => 'NGN',
                            }, 100),

                        TextEntry::make('received_amount')
                            ->money(fn(Conversion $record) => match ($record->to_currency) {
                                Currency::AWG => 'AWG',
                                Currency::USD => 'USD',
                                Currency::NGN => 'NGN',
                            }, 100),

                        TextEntry::make('rate')
                            ->money(fn(Conversion $record) => match ($record->to_currency) {
                                Currency::AWG => 'AWG',
                                Currency::USD => 'USD',
                                Currency::NGN => 'NGN',
                            }, 100),

                        TextEntry::make('created_at')
                            ->since()
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaction.reference'),

                Tables\Columns\TextColumn::make('transaction.amount')
                    ->label('Amount')
                    ->money(fn(Conversion $record) => match ($record->transaction->currency) {
                        Currency::AWG => 'AWG',
                        Currency::USD => 'USD',
                        Currency::NGN => 'NGN',
                    }, 100),

                Tables\Columns\TextColumn::make('received_amount')
                    ->money(fn(Conversion $record) => match ($record->to_currency) {
                        Currency::AWG => 'AWG',
                        Currency::USD => 'USD',
                        Currency::NGN => 'NGN',
                    }, 100),

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
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: false),

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
            'index' => Pages\ListConversions::route('/'),
            'create' => Pages\CreateConversion::route('/create'),
//            'edit' => Pages\EditConversion::route('/{record}/edit'),
        ];
    }
}
