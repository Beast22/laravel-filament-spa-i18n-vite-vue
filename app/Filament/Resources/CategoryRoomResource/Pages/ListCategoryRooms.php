<?php

namespace App\Filament\Resources\CategoryRoomResource\Pages;

use App\Filament\Resources\CategoryRoomResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategoryRooms extends ListRecords
{
    protected static string $resource = CategoryRoomResource::class;

    use ListRecords\Concerns\Translatable;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
