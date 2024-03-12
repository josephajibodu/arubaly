<?php

namespace App\Filament\Resources;

use App\Enums\MerchantAvailability;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Profile Info')
                    ->schema([
                        TextEntry::make('email'),

                        TextEntry::make('firstname'),

                        TextEntry::make('lastname'),

                        TextEntry::make('username'),

                        TextEntry::make('phonenumber'),

                        TextEntry::make('whatsappnumber'),
                    ])->columns(2),

                Section::make('Role Info')
                    ->schema([
                        IconEntry::make('is_user')
                            ->label('User')
                            ->getStateUsing(fn(User $record) => true)
                            ->boolean(),

                        IconEntry::make('Compiler')
                            ->getStateUsing(fn(User $record) => $record->hasRole('compiler'))
                            ->boolean(),

                        IconEntry::make('Merchant')
                            ->getStateUsing(fn(User $record) => $record->hasRole('merchant'))
                            ->boolean(),

                        IconEntry::make('Admin')
                            ->getStateUsing(fn(User $record) => $record->hasRole('admin'))
                            ->boolean(),
                    ])->columns(4),

                Section::make('Banking Details')
                    ->schema([
                        TextEntry::make('accountname'),

                        TextEntry::make('bankname'),

                        TextEntry::make('accountnumber'),
                    ])->columns(2),

                Section::make('Merchant Details')
                    ->hidden(fn(User $record) => !$record->hasRole('merchant'))
                    ->schema([
                        TextEntry::make('rate')
                            ->money('NGN', 100),

                        TextEntry::make('min_amount')
                            ->money('NGN', 100),

                        TextEntry::make('max_amount')
                            ->money('NGN', 100),

                        TextEntry::make('payment_type'),

                        TextEntry::make('terms')
                            ->columnSpan(2),

                        TextEntry::make('availability')
                            ->icon(fn (MerchantAvailability $state): string => match ($state) {
                                MerchantAvailability::AVAILABLE => 'heroicon-o-check-circle',
                                MerchantAvailability::SOLDOUT => 'heroicon-o-x-mark',
                            })
                            ->color(fn (MerchantAvailability $state): string => match ($state) {
                                MerchantAvailability::AVAILABLE => 'success',
                                MerchantAvailability::SOLDOUT => 'danger',
                            })
                    ])->columns(2),

                Actions::make([
                    Actions\Action::make('editRoles')
                        ->form([
                            Forms\Components\Checkbox::make('compiler')
                                ->default(fn(User $record) => $record->hasRole('compiler')),

                            Forms\Components\Checkbox::make('merchant')
                                ->default(fn(User $record) => $record->hasRole('merchant')),

                            Forms\Components\Checkbox::make('admin')
                                ->default(fn(User $record) => $record->hasRole('admin')),
                        ])
                        ->action(function (User $record, array $data) {
                            foreach ($data as $key => $value) {
                                if ($value) {
                                    $record->assignRole($key);
                                } else {
                                    $record->removeRole($key);
                                }
                            }

                            Notification::make()
                                ->title('User roles updated.')
                                ->success()
                                ->send();
                        })
                ])
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Profile Info')
                    ->schema([
                        Forms\Components\TextInput::make('firstname')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('lastname')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('username')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phonenumber')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('whatsappnumber')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bankname')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('accountname')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('accountnumber')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Merchant Details')
                    ->hidden(fn(User $record) => !$record->hasRole('merchant'))
                    ->schema([
                        Forms\Components\TextInput::make('rate')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('min_amount')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('max_amount')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('payment_type')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('terms')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('availability')
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Security')
                    ->hidden(fn() => $form->getOperation() == 'view')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('password_confirmation')
                            ->password()
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('username')
                    ->searchable(),
                Tables\Columns\TextColumn::make('firstname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lastname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phonenumber')
                    ->searchable(),
                Tables\Columns\TextColumn::make('whatsappnumber')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' => Pages\ViewUser::route('/{record}'),
        ];
    }
}
