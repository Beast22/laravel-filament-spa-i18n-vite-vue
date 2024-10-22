<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GoodResource\Pages;
use App\Filament\Resources\GoodResource\RelationManagers;
use App\Models\Good;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Cache;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Support\Facades\App;


class GoodResource extends Resource
{
    use Translatable;

    protected static ?string $model = Good::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil';
    protected static ?string $navigationLabel = 'Objects';
    protected static ?string $navigationGroup = 'Data';
    public static ?string $title = 'Objects';
    public static ?string $slug = 'objects';
    public static ?string $label = 'Object';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required(),
                TextInput::make('city')
                    ->required(),
                TextInput::make('beds')
                    ->required(),
                TextInput::make('bath')
                    ->required(),
                TextInput::make('floor')
                    ->required(),
                TextInput::make('square')
                    ->required(),
                TextInput::make('price')
                    ->required(),
                Fieldset::make('Toggles')
                    ->schema([
                        Toggle::make('is_published')
                            ->default(true)
                            ->inline(false),
                        Toggle::make('latest')
                            ->default(false)
                            ->inline(false),
                    ])
                    ->columns(5),
                Fieldset::make('Rent')
                    ->schema([
                        Select::make('category_city_id')
                            ->relationship('categoryCity', 'city->' . App::getLocale(), static function($query) {
                                return $query->where('category_id', 2)->orderBy('id');
                            }),
                        Select::make('category_price_id')
                            ->relationship('categoryPrice', 'price->' . App::getLocale(), static function($query) {
                                return $query->where('category_id', 2)->orderBy('id');
                            }),
                        Select::make('category_room_id')
                            ->relationship('categoryRoom', 'room->' . App::getLocale(), static function($query) {
                                return $query->where('category_id', 2)->orderBy('id');
                        }),
                    ])
                    ->columns(3),
                Fieldset::make('Buy')
                    ->schema([
                        Select::make('category_city_id')
                            ->relationship('categoryCity', 'city->' . App::getLocale(), static function($query) {
                                return $query->where('category_id', 1)->orderBy('id');
                        }),
                        Select::make('category_price_id')
                            ->relationship('categoryPrice', 'price->' . App::getLocale(), static function($query) {
                                return $query->where('category_id', 1)->orderBy('id');
                            }),
                        Select::make('category_room_id')
                            ->relationship('categoryRoom', 'room->' . App::getLocale(), static function($query) {
                                return $query->where('category_id', 1)->orderBy('id');
                        }),
                    ])
                    ->columns(3),
                SpatieMediaLibraryFileUpload::make('photos')
                    ->multiple()
                    ->acceptedFileTypes(['image/jpeg'])
                    ->label('Photos')
                    ->image()
                    ->imagePreviewHeight('100')
                    ->collection('goods'),
                SpatieMediaLibraryFileUpload::make('floorplants')
                    ->multiple()
                    ->acceptedFileTypes(['image/jpeg'])
                    ->label('Floorplants')
                    ->image()
                    ->imagePreviewHeight('100')
                    ->collection('floorplants'),
                TextInput::make('video'),

                Card::make()->columns(1)->schema([
                    RichEditor::make('descr')
                        ->label('Description')
                        ->disableToolbarButtons([
                            'attachFiles',
                        ]),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Grid::make([
                    'sm' => 2,
                    'md' => 2,
                    'lg' => 6,
                    '2xl' => 12,
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
                            ->description('ID')
                            ->sortable()
                            ->colors(['primary']),
                    ]),
                    TextColumn::make('title')
                        ->label('title')
                        ->description('title', position: 'above')
                        ->sortable(query: function (Builder $query, string $direction): Builder {
                            return $query->orderBy('title->' . App::getLocale(), $direction);
                        })
                        ->searchable()
                        ->columnSpan([
                            '2xl' => 2,
                        ]),
                    TextColumn::make('city')
                        ->label('city')
                        ->description('city', position: 'above')
                        ->sortable()
                        ->searchable(),
                    Stack::make([
                        TextColumn::make('beds')
                            ->label('beds')
                            ->description('beds', position: 'above')
                            ->sortable()
                            ->searchable(),
                        TextColumn::make('bath')
                            ->label('bath')
                            ->description('bath', position: 'above')
                            ->sortable()
                            ->searchable(),
                        TextColumn::make('floor')
                            ->label('floor')
                            ->description('floor', position: 'above')
                            ->sortable()
                            ->searchable(),
                    ])->alignment('center'),
                    TextColumn::make('square')
                        ->label('square')
                        ->description('square (m²)', position: 'above')
                        ->sortable()
                        ->searchable(),
                    TextColumn::make('price')
                        ->label('price')
                        ->description('price (€)', position: 'above')
                        ->sortable()
                        ->searchable(),
                    Stack::make([
                        TextColumn::make('category-description')
                            ->description('category', position: 'above')
                            ->visibleFrom('md'),
                        TextColumn::make('category-description')
                            ->description('category')
                            ->hiddenFrom('md'),
                        BadgeColumn::make('categoryCity.category.title')
                            ->label('category')
                            ->description('category', position: 'above')
                            ->colors(['secondary'])
                            ->icons(['heroicon-o-tag']),
                    ]),
                    Stack::make([
                        TextColumn::make('publish-description')
                            ->description('published', position: 'above')
                            ->visibleFrom('md'),
                        TextColumn::make('publish-description-m')
                            ->description('published')
                            ->hiddenFrom('md'),
                        IconColumn::make('is_published')
                            ->boolean()
                            ->trueColor('primary')
                            ->falseColor('warning'),
                    ]),
                    Stack::make([
                        TextColumn::make('latest-description')
                            ->description('favourite', position: 'above')
                            ->visibleFrom('md'),
                        TextColumn::make('latest-description-m')
                            ->description('favourite')
                            ->hiddenFrom('md'),
                        IconColumn::make('latest')
                            ->boolean()
                            ->trueColor('primary')
                            ->falseColor('warning'),
                    ]),
                    Stack::make([
                        TextColumn::make('photos-description')
                            ->description('photos', position: 'above')
                            ->visibleFrom('md'),
                        SpatieMediaLibraryImageColumn::make('photos')
                            ->label('photos')
                            ->collection('goods')
                            ->conversion('preview')
                            ->size(70)
                            ->visibleFrom('md'),
                    ]),
                    Stack::make([
                        TextColumn::make('floorplans-description')
                            ->description('floorplans', position: 'above')
                            ->visibleFrom('md'),
                        SpatieMediaLibraryImageColumn::make('floorplants')
                            ->label('floorplants')
                            ->collection('floorplants')
                            ->conversion('preview')
                            ->size(70)
                            ->visibleFrom('md'),
                        ])
                    ]),
            ])
            ->filters([
                Filter::make('is_published')
                    ->label('not published')
                    ->query(fn (Builder $query): Builder => $query->where('is_published', false)),
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
            'index' => Pages\ListGoods::route('/'),
            'create' => Pages\CreateGood::route('/create'),
            'edit' => Pages\EditGood::route('/{record}/edit'),
        ];
    }    
}
