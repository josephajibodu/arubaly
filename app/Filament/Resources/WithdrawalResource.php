<?php

namespace App\Filament\Resources;

use App\Enums\TradeStatus;
use App\Filament\Resources\WithdrawalResource\Pages;
use App\Filament\Resources\WithdrawalResource\RelationManagers;
use App\Models\Transfer;
use App\Models\Withdrawal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WithdrawalResource extends Resource
{
    protected static ?string $model = Withdrawal::class;

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
                            ->money('NGN', 100),
                        TextEntry::make('transaction.description')
                            ->label('Description'),
                    ])->columns(2),
                Section::make('Payment Details')
                    ->schema([
                        TextEntry::make('bankname'),
                        TextEntry::make('accountname'),
                        TextEntry::make('accountnumber')
                            ->copyable()
                            ->copyMessage('Copied!')
                            ->copyMessageDuration(1500),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaction.reference'),
                Tables\Columns\TextColumn::make('transaction.user.username')
                    ->label('Username'),
                Tables\Columns\TextColumn::make('transaction.description')
                    ->label('Description'),
                Tables\Columns\TextColumn::make('transaction.amount')
                    ->label('Amount')
                    ->money('NGN', 100),
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
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('approveWithdrawal')
                    ->label('Settle')
                    ->button()
                    ->color('success')
                    ->size(ActionSize::ExtraSmall)
                    ->requiresConfirmation()
                    ->modalHeading('Settle Withdrawal')
                    ->modalDescription('Doing this means the funds has been transferred to the users account.')
                    ->modalSubmitActionLabel('Yes. Settle Withdrawal')
                    ->visible(fn (Withdrawal $record) => $record->transaction->status == TradeStatus::PENDING)
                    ->action(fn (Withdrawal $record) => $record->transaction->update(['status' => TradeStatus::COMPLETED])),
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
            'index' => Pages\ListWithdrawals::route('/'),
            'create' => Pages\CreateWithdrawal::route('/create'),
//            'edit' => Pages\EditWithdrawal::route('/{record}/edit'),
        ];
    }
}
