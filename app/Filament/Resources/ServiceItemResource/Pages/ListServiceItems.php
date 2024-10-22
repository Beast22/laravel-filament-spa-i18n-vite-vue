<?php

namespace App\Filament\Resources\ServiceItemResource\Pages;

use App\Filament\Resources\ServiceItemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceItems extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = ServiceItemResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
