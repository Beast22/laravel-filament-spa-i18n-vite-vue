<?php

namespace App\Filament\Resources\BlogEntryResource\Pages;

use App\Filament\Resources\BlogEntryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlogEntry extends EditRecord
{
    protected static string $resource = BlogEntryResource::class;

    use EditRecord\Concerns\Translatable;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
