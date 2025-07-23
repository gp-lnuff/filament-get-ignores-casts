<?php

namespace App\Filament\Resources\SomeParentResource\Pages;

use App\Filament\Resources\SomeParentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSomeParent extends EditRecord
{
    protected static string $resource = SomeParentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
