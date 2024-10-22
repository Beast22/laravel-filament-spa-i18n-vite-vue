<?php

namespace App\Filament\Resources\AboutTitleResource\Pages;

use App\Filament\Resources\AboutTitleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutTitles extends ListRecords
{
    protected static string $resource = AboutTitleResource::class;

    use ListRecords\Concerns\Translatable;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }

    protected function isTablePaginationEnabled(): bool 
    {
        return false;
    } 
}
