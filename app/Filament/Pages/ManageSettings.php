<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GeneralSetting::class;

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('site_name'),

                Forms\Components\TextInput::make('whatsapp_group_link')
                    ->placeholder('https://api.whatsapp.com/+234...')
                    ->helperText('A proper link starting with https://'),

                Forms\Components\TextInput::make('awg_rate')
                    ->numeric()
                    ->suffix('NGN'),

                Forms\Components\TextInput::make('usd_rate_official')
                    ->numeric()
                    ->suffix('NGN'),

                Forms\Components\TextInput::make('usd_rate_parallel')
                    ->numeric()
                    ->suffix('NGN'),

                Forms\Components\TextInput::make('exchange_fee_percentage')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->suffix('%'),

                Forms\Components\TextInput::make('payment_limit')
                    ->numeric()
                    ->suffix('minutes'),

                Forms\Components\TextInput::make('aruba_to_usd_processing_time')
                    ->numeric()
                    ->suffix('minutes'),

                Forms\Components\TextInput::make('usd_to_naira_processing_time_official')
                    ->numeric()
                    ->suffix('minutes'),

                Forms\Components\TextInput::make('usd_to_naira_processing_time_parallel_market')
                    ->numeric()
                    ->suffix('minutes'),
            ]);
    }
}
