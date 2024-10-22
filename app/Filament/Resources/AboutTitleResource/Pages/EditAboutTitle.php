<?php

namespace App\Filament\Resources\AboutTitleResource\Pages;

use App\Filament\Resources\AboutTitleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAboutTitle extends EditRecord
{
    protected static string $resource = AboutTitleResource::class;

    use EditRecord\Concerns\Translatable;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
