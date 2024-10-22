<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutTitleResource\Pages;
use App\Filament\Resources\AboutTitleResource\RelationManagers;
use App\Models\AboutTitle;
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
use Filament\Forms\Components\MarkdownEditor;

class AboutTitleResource extends Resource
{
    use Translatable;

    protected static ?string $model = AboutTitle::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationLabel = 'About';
    protected static ?string $navigationGroup = 'Data';
    public static ?string $title = 'About us';
    public static ?string $label = 'Details';
    public static ?string $slug = 'about';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Title')
                    ->required(),
                MarkdownEditor::make('descr')
                    ->label('Text')
                    ->required()
                    ->disableToolbarButtons([
                        'attachFiles',
                        'codeBlock',
                        'preview',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Grid::make([
                    'md' => 3,
                    'xl' => 3,
                    '2xl' => 3,
                ])
                ->schema([
                    TextColumn::make('title')
                        ->label('Title')
                        ->description('Title', position: 'above')
                        ->extraAttributes([
                            'class' => 'mb-6 no-sort no-select',
                        ])
                        ->columnSpan([
                            'md' => 1,
                            'xl' => 1,
                            '2xl' => 1,
                        ]),

                    TextColumn::make('descr')
                        ->description('Text', position: 'above')
                        ->extraAttributes([
                            'class' => 'mb-6',
                        ])
                        ->columnSpan([
                            'md' => 2,
                            'xl' => 2,
                            '2xl' => 2,
                        ]),
                ])
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
            'index' => Pages\ListAboutTitles::route('/'),
            'edit' => Pages\EditAboutTitle::route('/{record}/edit'),
        ];
    }    
}
