<?php

namespace App\Filament\Manager\Resources\AttendanceListResource\Pages;

use App\Filament\Manager\Resources\AttendanceListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListAttendanceLists extends ListRecords
{
    protected static string $resource = AttendanceListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery()->orderBy('AttendanceDate', 'desc');
    }
}
