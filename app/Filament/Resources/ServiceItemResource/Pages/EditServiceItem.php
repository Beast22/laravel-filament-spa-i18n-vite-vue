<?php

namespace App\Filament\Resources\ServiceItemResource\Pages;

use App\Filament\Resources\ServiceItemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceItem extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = ServiceItemResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
