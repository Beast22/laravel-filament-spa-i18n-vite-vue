<?php

namespace App\Filament\Resources\CategoryPriceResource\Pages;

use App\Filament\Resources\CategoryPriceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategoryPrices extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = CategoryPriceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
