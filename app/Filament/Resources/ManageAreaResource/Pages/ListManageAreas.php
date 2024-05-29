<?php

namespace App\Filament\Resources\ManageAreaResource\Pages;

use App\Filament\Resources\ManageAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManageAreas extends ListRecords
{
    protected static string $resource = ManageAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
