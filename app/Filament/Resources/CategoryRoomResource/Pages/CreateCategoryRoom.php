<?php

namespace App\Filament\Resources\CategoryRoomResource\Pages;

use App\Filament\Resources\CategoryRoomResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategoryRoom extends CreateRecord
{
    protected static string $resource = CategoryRoomResource::class;

    use CreateRecord\Concerns\Translatable;
 
    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
