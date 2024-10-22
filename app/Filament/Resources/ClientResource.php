<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class ClientResource extends Resource
{
    use Translatable;

    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Reviews';
    protected static ?string $navigationGroup = 'Data';
    public static ?string $label = 'Reviews of our clients';
    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->columns(2)->schema([
                    SpatieMediaLibraryFileUpload::make('client_avatar')
                        ->image()
                        ->imagePreviewHeight('100')
                        ->collection('default'),
                    TextInput::make('name'),
                    MarkdownEditor::make('descr')
                        ->disableToolbarButtons([
                            'attachFiles',
                            'preview',
                        ])
                        ->label('Review text'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            SpatieMediaLibraryImageColumn::make('client_avatar')
                ->collection('default')
                ->size(100)
                ->conversion('preview')
                ->extraAttributes([
                    'class' => 'mb-3 no-sort no-select'
                ]),
            TextColumn::make('name')
                ->extraAttributes([
                    'class' => 'mb-3'
                ]),
            TextColumn::make('descr')
                ->extraAttributes([
                    'class' => 'text-gray-500 dark:text-gray-300 text-xs'
                ]),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 2,
                '2xl' => 2,
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getTranslatableLocales(): array
    {
        return ['en', 'ru'];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }    
}
