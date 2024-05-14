<?php

namespace App\Filament\Resources\ManageAccessResource\Pages;

use App\Filament\Resources\ManageAccessResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManageAccesses extends ListRecords
{
    protected static string $resource = ManageAccessResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
