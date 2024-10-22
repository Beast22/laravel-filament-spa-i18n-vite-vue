<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingsResource\Pages;
use App\Filament\Resources\SiteSettingsResource\RelationManagers;
use App\Models\SiteSettings;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Resources\Concerns\Translatable;
use Filament\Forms\Components\RichEditor;

class SiteSettingsResource extends Resource
{
    use Translatable;

    protected static ?string $model = SiteSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Site info';
    protected static ?string $navigationGroup = 'Settings';
    public static ?string $title = 'Manage global info';
    public static ?string $slug = 'global-info';
    public static ?string $label = 'Text settings';
    protected static ?int $navigationSort = 2;
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('site_slogan')
                    ->label('Site slogan')
                    ->required()
                    ->autofocus(),
                TextInput::make('site_geo')
                    ->label('Site geo')
                    ->required()
                    ->autofocus(),
                RichEditor::make('site_message')
                    ->label('Site message')
                    ->required()
                    ->disableToolbarButtons([
                        'attachFiles',
                        'preview',
                        'blockquote',
                        'strike',
                        'orderedList',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Grid::make([
                    'md' => 3,
                    'xl' => 4,
                    '2xl' => 4,
                ])
                ->schema([
                    TextColumn::make('site_slogan')
                        ->label('Site slogan')
                        ->description('Site slogan', position: 'above')
                        ->extraAttributes([
                            'class' => 'mb-6 no-sort no-select',
                        ]),
                    TextColumn::make('site_geo')
                        ->label('Site geo')
                        ->description('Site geo', position: 'above')
                        ->extraAttributes([
                            'class' => 'mb-6',
                        ]),
                    TextColumn::make('site_message')
                        ->label('Site message')
                        ->description('Site message', position: 'above')
                        ->extraAttributes([
                            'class' => 'mb-6',
                        ])
                        ->columnSpan([
                            'xl' => 2,
                            '2xl' => 2,
                        ]),
                ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);

    }
    
    public static function getTranslatableLocales(): array
    {
        return ['en', 'ru'];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteSettings::route('/'),
            'edit' => Pages\EditSiteSettings::route('/{record}/edit'),
        ];
    }    
}
