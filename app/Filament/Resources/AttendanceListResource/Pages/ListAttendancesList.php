<?php

namespace App\Filament\Resources\AttendanceListResource\Pages;

use App\Filament\Resources\AttendanceListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AttendanceListResource\Widgets\SummarizeAttendance;
use App\Filament\Resources\AttendanceListResource\Widgets\OnLeaveAttendance;
use App\Filament\Resources\AttendanceListResource\Widgets\AbsentAttendance;

class ListAttendancesList extends ListRecords
{
    protected static string $resource = AttendanceListResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            SummarizeAttendance::class,
            AbsentAttendance::class,
            OnLeaveAttendance::class,
        ];
    }

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
