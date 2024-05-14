<?php

namespace App\Filament\Resources\AttendanceReportResource\Widgets;

use App\Models\Attendance;
use Filament\Widgets\ChartWidget;

class AttendanceTrendChart extends ChartWidget
{
    //protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Attendance Trends by Shift';

    protected function getData(): array
    {
        $attendanceData = Attendance::select('ShiftSession_ID')
            ->groupBy('ShiftSession_ID')
            ->orderBy('ShiftSession_ID')
            ->get();

        $shiftAttendanceCounts = $attendanceData->map(function ($item) {
            return [
                'shift' => $item->ShiftSession_ID === 1 ? 'Punch In' : 'Punch Out', // Assigning labels based on ShiftSession_ID
                'count' => Attendance::where('ShiftSession_ID', $item->ShiftSession_ID)->count(),
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
