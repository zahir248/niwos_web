<?php

namespace App\Filament\Resources\DeletedAccessListResource\Pages;

use App\Filament\Resources\DeletedAccessListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDeletedAccessLists extends ListRecords
{
    protected static string $resource = DeletedAccessListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
