<?php

namespace App\Filament\Manager\Resources\ManageLeaveRequestResource\Pages;

use App\Filament\Manager\Resources\ManageLeaveRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Attendance;
use Carbon\Carbon;

class EditManageLeaveRequest extends EditRecord
{
    protected static string $resource = ManageLeaveRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTitle(): string
    {
        return 'Leave Request Response'; // Change the page title here
    }

    protected function afterSave(): void
    {
        $record = $this->record;

        // Extract necessary data
        $id = $record->id;
        $startDate = Carbon::parse($record->StartDate);
        $endDate = Carbon::parse($record->EndDate);

        // Check if the status is "Approved"
        if ($record->LeaveRequestStatus_ID === '1') {
            // Iterate through each day in the date range
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                // Insert data into the Attendance model for ShiftSession_ID 1
                Attendance::create([
                    'NW_Attendance_ID' => 'AT0000000', // Set NW_Attendance_ID
                    'PunchInTime' => null,
                    'PunchOutTime' => null,
                    'AttendanceDate' => $date->format('Y-m-d'),
                    'ShiftSession_ID' => 1,
                    'AttendanceStatus_ID' => 5,
                    'id' => $id,
                ]);

                // Insert data into the Attendance model for ShiftSession_ID 2
                Attendance::create([
                    'NW_Attendance_ID' => 'AT0000000', // Set NW_Attendance_ID
                    'PunchInTime' => null,
                    'PunchOutTime' => null,
                    'AttendanceDate' => $date->format('Y-m-d'),
                    'ShiftSession_ID' => 2,
                    'AttendanceStatus_ID' => 5,
                    'id' => $id,
                ]);
            }
        }
    }
}
