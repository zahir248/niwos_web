<?php

namespace App\Filament\Manager\Resources\AttendanceListResource\Pages;

use App\Filament\Manager\Resources\AttendanceListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttendanceList extends EditRecord
{
    protected static string $resource = AttendanceListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
