<?php

namespace App\Filament\Resources\BlogEntryResource\Pages;

use App\Filament\Resources\BlogEntryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBlogEntry extends CreateRecord
{
    protected static string $resource = BlogEntryResource::class;

    use CreateRecord\Concerns\Translatable;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
