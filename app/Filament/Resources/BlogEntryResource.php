<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogEntryResource\Pages;
use App\Filament\Resources\BlogEntryResource\RelationManagers;
use App\Models\BlogEntry;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Concerns\Translatable;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Support\Facades\App;

class BlogEntryResource extends Resource

{
    use Translatable;

    protected static ?string $model = BlogEntry::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Blog';
    protected static ?string $navigationGroup = 'Blog';
    public static ?string $title = 'Blog entry';
    public static ?string $label = 'blog entry';
    public static ?string $slug = 'blog';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
        ->columns(5)
        ->schema([
            Grid::make(1)
                ->columnSpan(3)
                ->schema([
                    TextInput::make('title')
                        ->label('Title')
                        ->required()
                        ->autofocus(),
                    RichEditor::make('text')
                        ->label('Text')
                        ->required()
                        ->disableToolbarButtons([
                            'attachFiles',
                        ]),
                ]),
            Grid::make(1)
                ->columnSpan(2)
                ->schema([
                    Toggle::make('is_published')
                        ->label('Is published')
                        ->default(true)
                        ->inline(false),
                    SpatieMediaLibraryFileUpload::make('image')
                        ->label('Image')
                        ->required()
                        ->image()
                        ->collection('blog'),

                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                BadgeColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->colors(['primary']),
                TextColumn::make('title')
                    ->label('Title')
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('title->' . App::getLocale(), $direction);
                    })
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Cover')
                    ->collection('blog')
                    ->height(70),
                IconColumn::make('is_published')
                    ->label('Is published')
                    ->boolean()
                    ->trueColor('primary')
                    ->falseColor('warning')
            ])
            ->defaultSort('id')
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
            'index' => Pages\ListBlogEntries::route('/'),
            'create' => Pages\CreateBlogEntry::route('/create'),
            'edit' => Pages\EditBlogEntry::route('/{record}/edit'),
        ];
    }    
}
