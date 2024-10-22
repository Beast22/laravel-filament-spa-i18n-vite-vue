<?php

namespace App\Filament\Resources\CategoryPriceResource\Pages;

use App\Filament\Resources\CategoryPriceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoryPrice extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = CategoryPriceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
