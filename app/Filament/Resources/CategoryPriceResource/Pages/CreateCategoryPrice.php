<?php

namespace App\Filament\Resources\CategoryPriceResource\Pages;

use App\Filament\Resources\CategoryPriceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategoryPrice extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = CategoryPriceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
