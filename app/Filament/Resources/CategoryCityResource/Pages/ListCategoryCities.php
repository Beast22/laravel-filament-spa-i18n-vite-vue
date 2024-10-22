<?php

namespace App\Filament\Resources\CategoryCityResource\Pages;

use App\Filament\Resources\CategoryCityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategoryCities extends ListRecords
{
    protected static string $resource = CategoryCityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
