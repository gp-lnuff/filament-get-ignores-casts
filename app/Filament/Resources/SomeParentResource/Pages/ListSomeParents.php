<?php

namespace App\Filament\Resources\SomeParentResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\SomeParentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSomeParents extends ListRecords
{
    protected static string $resource = SomeParentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
