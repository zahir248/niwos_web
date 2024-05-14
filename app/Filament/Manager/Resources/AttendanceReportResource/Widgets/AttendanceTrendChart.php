<?php

namespace App\Filament\Manager\Resources\AttendanceReportResource\Widgets;

use App\Models\Attendance;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class AttendanceTrendChart extends ChartWidget
{
    //protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Attendance Trends by Shift';

    protected function getData(): array
    {
        // Get the logged-in user's ID
        $userId = Auth::user()->id;

        // Retrieve attendance data for the users managed by the logged-in user
        $attendanceData = Attendance::whereHas('user', function ($query) use ($userId) {
                $query->where('Manager_ID', $userId);
            })
            ->select('ShiftSession_ID')
            ->groupBy('ShiftSession_ID')
            ->orderBy('ShiftSession_ID')
            ->get();

        $shiftAttendanceCounts = $attendanceData->map(function ($item) use ($userId) {
            return [
                'shift' => $item->ShiftSession_ID === 1 ? 'Punch In' : 'Punch Out', // Assigning labels based on ShiftSession_ID
                'count' => Attendance::whereHas('user', function ($query) use ($userId, $item) {
                    $query->where('Manager_ID', $userId);
                })->where('ShiftSession_ID', $item->ShiftSession_ID)->count(),
            ];
        });

        // Prepare data in the format required by the chart library
        $chartData = [
            'labels' => $shiftAttendanceCounts->pluck('shift')->toArray(),
            'datasets' => [
                [
                    'label' => 'Attendance by Shift',
                    'data' => $shiftAttendanceCounts->pluck('count')->toArray(),
                    'backgroundColor' => [
                        '#FF6384', // Red
                        '#36A2EB', // Blue
                        '#FFCE56', // Yellow
                        // Add more colors as needed
                    ],
                ],
            ],
        ];

        return $chartData;
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
