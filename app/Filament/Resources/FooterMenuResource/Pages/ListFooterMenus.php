<?php

namespace App\Filament\Resources\FooterMenuResource\Pages;

use App\Filament\Resources\FooterMenuResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFooterMenus extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = FooterMenuResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
