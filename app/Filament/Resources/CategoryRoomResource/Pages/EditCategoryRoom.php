<?php

namespace App\Filament\Resources\CategoryRoomResource\Pages;

use App\Filament\Resources\CategoryRoomResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoryRoom extends EditRecord
{
    protected static string $resource = CategoryRoomResource::class;

    use EditRecord\Concerns\Translatable;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
