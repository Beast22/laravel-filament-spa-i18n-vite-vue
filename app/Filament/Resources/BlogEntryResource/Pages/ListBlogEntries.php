<?php

namespace App\Filament\Resources\BlogEntryResource\Pages;

use App\Filament\Resources\BlogEntryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogEntries extends ListRecords
{
    protected static string $resource = BlogEntryResource::class;

    use ListRecords\Concerns\Translatable;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
