<?php

namespace App\Filament\Resources\SiteSettingsResource\Pages;

use App\Filament\Resources\SiteSettingsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiteSettings extends ListRecords
{

    use ListRecords\Concerns\Translatable;

    protected static string $resource = SiteSettingsResource::class;

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
