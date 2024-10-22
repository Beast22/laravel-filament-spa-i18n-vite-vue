<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Application;
use Closure;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Concerns\Translatable;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class CustomerResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Customers';
    protected static ?string $navigationGroup = 'Data';
    public static ?string $title = 'Customers';
    public static ?string $slug = 'customers';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id')
                ->numeric(),
                TextInput::make('name')
                    ->required()
                    ->autofocus()
                    ->reactive()
                    ->afterStateUpdated(function (Closure $set, $state) {
                        $set('slug', Str::slug($state));
                 }),
                TextInput::make('tel')
                    ->tel()
                    ->required(),
                TextInput::make('country'),
                TextInput::make('object')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                BadgeColumn::make('id')
                    ->sortable()
                    ->colors(['primary']),
                TextColumn::make('name')
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('title', $direction);
                    })
                    ->searchable(),
                TextColumn::make('tel'),    
                TextColumn::make('country'),    
                TextColumn::make('object'),    
            ])
            ->defaultSort('id')
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
            'index' => Pages\ListCustomers::route('/'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }    
}
