<?php

namespace App\Filament\Pages;

use App\Settings\GlobalSettings;
use Filament\Forms;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Forms\Components\Textarea;

class ManageGlobal extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = GlobalSettings::class;

    protected static ?string $navigationLabel = 'Site settings';
    protected static ?string $navigationGroup = 'Settings';
    public static ?string $title = 'Manage global settings';
    public static ?string $slug = 'manage-global';

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('site_tel')
                ->label('tel')
                ->required()
                ->mask(fn (Mask $mask) => $mask->pattern('+000 00 00 00000')),
            TextInput::make('site_tel_2')
                ->label('tel_2')
                ->required()
                ->mask(fn (Mask $mask) => $mask->pattern('+000 00 00 00000')),
            TextInput::make('site_email')
                ->label('Site email')
                ->required(),
            FileUpload::make('site_logo')
                ->label('Logo image')
                ->image()
                ->directory('logo')
                ->preserveFilenames(),
        ];
    }
}
