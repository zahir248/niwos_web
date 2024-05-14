<?php

namespace App\Filament\Manager\Resources\ManageLeaveRequestResource\Pages;

use App\Filament\Manager\Resources\ManageLeaveRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManageLeaveRequests extends ListRecords
{
    protected static string $resource = ManageLeaveRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
