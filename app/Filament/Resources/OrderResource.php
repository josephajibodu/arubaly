<?php

namespace App\Filament\Resources;

use App\Actions\Admin\CancelOrder;
use App\Enums\Currency;
use App\Enums\TradeStatus;
use App\Exceptions\InsufficientFundsException;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

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
                            ->money(fn(Order $record) => match ($record->transaction->currency) {
                                Currency::AWG => 'AWG',
                                Currency::USD => 'USD',
                                Currency::NGN => 'NGN',
                            }, 100),

                        TextEntry::make('transaction.description')
                            ->label('Description'),

                    ])->columns(2),

                Section::make('More Details')
                    ->schema([

                        TextEntry::make('payable_amount')
                            ->label('User pays')
                            ->money(fn(Order $record) => match ($record->payable_currency) {
                                Currency::AWG => 'AWG',
                                Currency::USD => 'USD',
                                Currency::NGN => 'NGN',
                            }, 100),

                        TextEntry::make('transaction.amount')
                            ->label('To Get')
                            ->money(fn(Order $record) => match ($record->transaction->currency) {
                                Currency::AWG => 'AWG',
                                Currency::USD => 'USD',
                                Currency::NGN => 'NGN',
                            }, 100),

                        TextEntry::make('merchant.username')
                            ->label('Merchant'),

                        TextEntry::make('transaction.user.username')
                            ->label('User'),

                        TextEntry::make('rate')
                            ->label('Merchant Rate')
                            ->money(fn(Order $record) => match ($record->payable_currency) {
                                Currency::AWG => 'AWG',
                                Currency::USD => 'USD',
                                Currency::NGN => 'NGN',
                            }, 100),

                        TextEntry::make('created_at')
                            ->since()
                    ])->columns(2),

//                Section::make('Actions')
//                    ->schema([
//
//                    ])
                Actions::make([
                    Action::make('cancelOrder')
                        ->icon('heroicon-m-x-mark')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->hidden(fn(Order $record) => $record->transaction->status == TradeStatus::CANCELLED)
                        ->action(function (Order $record, CancelOrder $cancelOrder) {
                            try {
                                $cancelOrder->execute($record->transaction);

                                Notification::make()
                                    ->title('Order cancelled. Merchant refunded.')
                                    ->success()
                                    ->send();
                            } catch (InsufficientFundsException $exception) {
                                Notification::make()
                                    ->title('There is not enough AWG coin in the users wallet.')
                                    ->danger()
                                    ->send();
                            }
                        })
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaction.reference'),

                Tables\Columns\TextColumn::make('merchant.username'),

                Tables\Columns\TextColumn::make('transaction.user.username'),

                Tables\Columns\TextColumn::make('transaction.amount')
                    ->label('Aruba Qty')
                    ->money(null, 100),

                Tables\Columns\TextColumn::make('payable_amount')
                    ->money(fn(Order $record) => match ($record->payable_currency) {
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }
}
