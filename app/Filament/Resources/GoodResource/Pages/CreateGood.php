<?php

namespace App\Filament\Resources\GoodResource\Pages;

use App\Filament\Resources\GoodResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGood extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = GoodResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
