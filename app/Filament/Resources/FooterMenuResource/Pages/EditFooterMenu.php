<?php

namespace App\Filament\Resources\FooterMenuResource\Pages;

use App\Filament\Resources\FooterMenuResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFooterMenu extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = FooterMenuResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
