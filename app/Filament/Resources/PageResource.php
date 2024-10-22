<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Stack;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    use Translatable;

    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Pages';
    protected static ?string $navigationGroup = 'Data';
    public static ?string $title = 'Pages';
    public static ?string $slug = 'pages';
    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->autofocus()
                    ->reactive()
                    ->afterStateUpdated(function (Closure $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('content')
                    ->label('Content')
                    ->autofocus()
                    ->reactive()
                    ->afterStateUpdated(function (Closure $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Grid::make([
                    'sm' => 2,
                    'md' => 2,
                    'lg' => 10,
                    '2xl' => 10,
                ])->schema([
                    Stack::make([
                        TextColumn::make('id-description')
                            ->description('ID', position: 'above')
                            ->visibleFrom('md'),
                        TextColumn::make('id-description')
                            ->description('ID')
                            ->hiddenFrom('md'), 
                        BadgeColumn::make('id')
                            ->label('ID')
                            ->description('ID', position: 'above')
                            ->sortable()
                            ->colors(['primary']),
                    ])                
                    ->extraAttributes([
                        'class' => 'mb-3'
                    ]),
                    TextColumn::make('title')
                        ->label('Title')
                        ->description('title', position: 'above')
                        ->sortable(query: function (Builder $query, string $direction): Builder {
                            return $query->orderBy('title->' . App::getLocale(), $direction);
                        })
                        ->searchable()
                        ->columnSpan([
                            'lg' => 4,
                            '2xl' => 4,
                        ])
                        ->extraAttributes([
                            'class' => 'mb-3'
                        ]),
                    TextColumn::make('content')
                        ->label('Content')
                        ->description('Content', position: 'above')
                        ->columnSpan([
                            'lg' => 2,
                            '2xl' => 2,
                        ])
                        ->extraAttributes([
                            'class' => 'mb-3'
                        ]),
                    Stack::make([
                        TextColumn::make('slug-description')
                            ->description('Slug', position: 'above')
                            ->visibleFrom('md'),
                        TextColumn::make('slug-description')
                            ->description('Slug')
                            ->hiddenFrom('md'), 
                        BadgeColumn::make('slug')
                            ->label('Slug')
                            ->sortable()
                            ->colors(['secondary']),
                    ]),
                ])
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }    
}
