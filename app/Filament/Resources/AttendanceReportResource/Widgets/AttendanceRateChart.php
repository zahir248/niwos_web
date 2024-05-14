<?php

namespace App\Filament\Resources\AttendanceReportResource\Widgets;

use App\Models\Attendance;
use Filament\Widgets\ChartWidget;

class AttendanceRateChart extends ChartWidget
{
    protected static ?string $heading = 'Attendance Rate Over Time - Present/ On Time';

    //protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $attendanceData = Attendance::select('AttendanceDate', 'AttendanceStatus_ID')
            ->orderBy('AttendanceDate')
            ->get();

        $attendanceByDate = $attendanceData->groupBy('AttendanceDate');

        $attendanceRateData = $attendanceByDate->map(function ($items) {
            $totalAttendance = $items->count();
            $onTimeCount = $items->where('AttendanceStatus_ID', '1')->count();
            $lateCount = $items->where('AttendanceStatus_ID', '2')->count();
            $tooEarlyCount = $items->where('AttendanceStatus_ID', '3')->count();
            
            // Calculate attendance rate as percentage
            $attendanceRate = $totalAttendance > 0 ? (($onTimeCount + $lateCount) / $totalAttendance) * 100 : 0;
            return round($attendanceRate, 2); // Round to two decimal places
        });

        // Prepare data in the format required by the chart library
        $chartData = [
            'labels' => $attendanceRateData->keys()->toArray(), // AttendanceDate
            'datasets' => [
                [
                    'label' => 'Attendance Rate',
                    'data' => $attendanceRateData->values()->toArray(), // Attendance Rate as percentage
                    'fill' => false, // No fill for line chart
                    'borderColor' => 'rgb(75, 192, 192)', // Line color
                    'lineTension' => 0.1, // Line tension (curvature)
                ],
            ],
        ];

        return $chartData;
    }

    protected function getType(): string
    {
        return 'line';
    }
}
