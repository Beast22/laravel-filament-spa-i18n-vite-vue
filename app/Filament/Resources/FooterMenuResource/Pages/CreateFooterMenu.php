<?php

namespace App\Filament\Resources\FooterMenuResource\Pages;

use App\Filament\Resources\FooterMenuResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFooterMenu extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = FooterMenuResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
