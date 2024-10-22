<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterMenuResource\Pages;
use App\Filament\Resources\FooterMenuResource\RelationManagers;
use App\Models\FooterMenu;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;
use Closure;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Resources\Concerns\Translatable;


class FooterMenuResource extends Resource
{   
    use Translatable;

    protected static ?string $model = FooterMenu::class;

    protected static ?string $navigationIcon = 'heroicon-o-chevron-double-up';
    protected static ?string $navigationLabel = 'Footer menu';
    protected static ?string $navigationGroup = 'Menu';
    public static ?string $title = 'Footer menu';
    public static ?string $label = 'menu item';
    public static ?string $slug = 'footer_menu';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('item')
                        ->reactive()
                        ->default('item') 
                        ->afterStateUpdated(function (Closure $set, $state) {
                            $set('slug', Str::slug($state));
                        })->required(),
                    TextInput::make('url')
                        ->default('/item'),
                    TextInput::make('item_index')
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Split::make([
                    TextColumn::make('item')->limit(50)->sortable(),
                    TextColumn::make('url')->sortable(),
                    TextColumn::make('item_index')->sortable(),
                // ])->from('md')
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
            'index' => Pages\ListFooterMenus::route('/'),
            'create' => Pages\CreateFooterMenu::route('/create'),
            'edit' => Pages\EditFooterMenu::route('/{record}/edit'),
        ];
    }    
}
