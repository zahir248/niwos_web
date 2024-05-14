<?php

namespace App\Filament\Manager\Resources\AttendanceReportResource\Pages;

use App\Filament\Manager\Resources\AttendanceReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttendanceReport extends EditRecord
{
    protected static string $resource = AttendanceReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
