<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryPriceResource\Pages;
use App\Filament\Resources\CategoryPriceResource\RelationManagers;
use App\Models\CategoryPrice;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Select;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;
use Closure;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class CategoryPriceResource extends Resource
{
    use Translatable;

    protected static ?string $model = CategoryPrice::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Price Category';
    protected static ?string $navigationGroup = 'Data';
    public static ?string $title = 'Price category';
    public static ?string $slug = 'category-prices';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->columns(2)->schema([
                    SpatieMediaLibraryFileUpload::make('cp_image')
                        ->image()
                        ->imagePreviewHeight('50')
                        ->collection('default')
                        ->label('Category image'),
                    TextInput::make('price'),
                    TextInput::make('slug'),
                    Select::make('category_id')
                        ->relationship('category', 'title', static function($query) {
                            return $query->orderBy('id');
                    }),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                BadgeColumn::make('id')
                    ->sortable()
                    ->colors(['primary']),
                SpatieMediaLibraryImageColumn::make('cp_image')
                    ->collection('default')
                    ->conversion('preview')
                    ->size(70)
                    ->label('Category image'),
                TextColumn::make('price'),
                BadgeColumn::make('category.title')
                    ->colors(['secondary'])
                    ->icons(['heroicon-o-tag']),
                BadgeColumn::make('slug')
                    ->colors(['secondary']),
                TextColumn::make('goods_count')
                    ->counts('goods')
                    ->label('Objects')
            ])
            ->filters([
                //
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
            'index' => Pages\ListCategoryPrices::route('/'),
            'create' => Pages\CreateCategoryPrice::route('/create'),
            'edit' => Pages\EditCategoryPrice::route('/{record}/edit'),
        ];
    }    
}
