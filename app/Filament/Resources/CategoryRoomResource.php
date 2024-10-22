<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryRoomResource\Pages;
use App\Filament\Resources\CategoryRoomResource\RelationManagers;
use App\Models\CategoryRoom;
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


class CategoryRoomResource extends Resource
{
    use Translatable;
    
    protected static ?string $model = CategoryRoom::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Room category';
    protected static ?string $navigationGroup = 'Data';
    public static ?string $title = 'Room category';
    public static ?string $slug = 'category-rooms';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->columns(2)->schema([
                    SpatieMediaLibraryFileUpload::make('cr_image')
                        ->image()
                        ->imagePreviewHeight('50')
                        ->collection('default')
                        ->label('Category image'),
                    TextInput::make('room'),
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
                SpatieMediaLibraryImageColumn::make('cr_image')
                    ->collection('default')
                    ->height(50)
                    ->label('Category image'),
                TextColumn::make('room'),
                BadgeColumn::make('category.title')
                    ->colors(['secondary'])
                    ->icons(['heroicon-o-tag']),
                BadgeColumn::make('slug')
                    ->colors(['secondary']),
                TextColumn::make('goods_count')
                    ->counts('goods')
                    ->label('Objects')
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
            'index' => Pages\ListCategoryRooms::route('/'),
            'create' => Pages\CreateCategoryRoom::route('/create'),
            'edit' => Pages\EditCategoryRoom::route('/{record}/edit'),
        ];
    }    
}
