<?php

namespace App\Filament\Resources\AttendanceListResource\Pages;

use App\Filament\Resources\AttendanceListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttendancesList extends ListRecords
{
    protected static string $resource = AttendanceListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
