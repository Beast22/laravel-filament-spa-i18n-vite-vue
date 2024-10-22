<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryCityResource\Pages;
use App\Filament\Resources\CategoryCityResource\RelationManagers;
use App\Models\CategoryCity;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;
use Closure;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class CategoryCityResource extends Resource
{
    use Translatable;
    
    protected static ?string $model = CategoryCity::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationLabel = 'City category';
    protected static ?string $navigationGroup = 'Data';
    public static ?string $title = 'City category';
    public static ?string $slug = 'category-cities';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->columns(2)->schema([
                    SpatieMediaLibraryFileUpload::make('cc_image')
                        ->image()
                        ->imagePreviewHeight('50')
                        ->collection('default')
                        ->label('Category image'),
                    TextInput::make('city'),
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
                SpatieMediaLibraryImageColumn::make('cc_image')
                    ->collection('default')
                    ->size(70)
                    ->label('Category image'),
                TextColumn::make('city'),
                BadgeColumn::make('category.title')
                    ->colors(['secondary'])
                    ->icons(['heroicon-o-tag']),
                BadgeColumn::make('slug')
                    ->colors(['secondary']),
                TextColumn::make('goods_count')
                    ->counts('goods')
                    ->label('Objects')
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
            'index' => Pages\ListCategoryCities::route('/'),
            'create' => Pages\CreateCategoryCity::route('/create'),
            'edit' => Pages\EditCategoryCity::route('/{record}/edit'),
        ];
    }    
}
