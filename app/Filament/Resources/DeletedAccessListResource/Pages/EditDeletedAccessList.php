<?php

namespace App\Filament\Resources\DeletedAccessListResource\Pages;

use App\Filament\Resources\DeletedAccessListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeletedAccessList extends EditRecord
{
    protected static string $resource = DeletedAccessListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
