<?php

namespace App\Filament\Resources\CategoryCityResource\Pages;

use App\Filament\Resources\CategoryCityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoryCity extends EditRecord
{
    protected static string $resource = CategoryCityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
