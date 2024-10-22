<?php

namespace App\Filament\Resources\GoodResource\Pages;

use App\Filament\Resources\GoodResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGoods extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = GoodResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
