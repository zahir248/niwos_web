<?php

namespace App\Filament\Manager\Resources\SubordinateResource\Pages;

use App\Filament\Manager\Resources\SubordinateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubordinates extends ListRecords
{
    protected static string $resource = SubordinateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
