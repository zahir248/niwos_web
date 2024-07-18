<?php

namespace App\Filament\Resources\AttendanceListResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SummarizeAttendance extends BaseWidget
{
    protected function getStats(): array
    {
        // Fetch attendance data where AttendanceStatus_ID is 2 (late) or 3 (on leave)
        $attendanceData = DB::table('attendance')
            ->join('users', 'attendance.id', '=', 'users.id') // Assuming NW_Attendance_ID links to users.id
            ->select('users.name', 'attendance.AttendanceDate', 'attendance.AttendanceStatus_ID')
            ->whereIn('attendance.AttendanceStatus_ID', [2, 5])
            ->get();

        // Prepare the stats array
        $stats = [];

        // Group the data by year, then by month
        $groupedData = $attendanceData->groupBy(function($item) {
            return Carbon::parse($item->AttendanceDate)->format('Y');
        })->map(function($yearData) {
            return $yearData->groupBy(function($item) {
                return Carbon::parse($item->AttendanceDate)->format('F Y');
            })->map(function($monthData) {
                return $monthData->groupBy('AttendanceStatus_ID')->map(function($statusData) {
                    return $statusData->groupBy('name');
                });
            });
        });

        // Loop through the grouped data to create a Stat for each month of each year
        foreach ($groupedData as $year => $months) {
            foreach ($months as $monthYear => $statuses) {
                $details = [];

                // Debugging: Check if there are any entries for late
                if (isset($statuses[2])) {
                    $lateDetails = $statuses[2]->map(function($userDates, $userName) {
                        $dates = $userDates->map(function($item) {
                            return Carbon::parse($item->AttendanceDate)->format('d/m/Y');
                        })->implode(', ');
                        return "$userName ($dates)";
                    })->implode(', ');
                    $details[] = "Late: $lateDetails";
                } else {
                    $details[] = "Late: No data";
                }

                // Debugging: Check if there are any entries for on leave
                if (isset($statuses[5])) {
                    $leaveDetails = $statuses[5]->map(function($userDates, $userName) {
                        $dates = $userDates->map(function($item) {
                            return Carbon::parse($item->AttendanceDate)->format('d/m/Y');
                        })->implode(', ');
                        return "$userName ($dates)";
                    })->implode(', ');
                    $details[] = "On Leave: $leaveDetails";
                } else {
                    $details[] = "On Leave: No data";
                }

                $stats[] = Stat::make("Attendance summary for $monthYear", count($statuses->flatten()))
                    ->description(implode(' | ', $details));
            }
        }

        return $stats;
    }
}
