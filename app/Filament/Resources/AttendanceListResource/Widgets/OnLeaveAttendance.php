<?php

namespace App\Filament\Resources\AttendanceListResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OnLeaveAttendance extends BaseWidget
{
    protected function getStats(): array
    {
        // Get the start and end dates for the current week
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');

        // Fetch attendance data where AttendanceStatus_ID is 5 (on leave) for the current week
        $attendanceData = DB::table('attendance')
            ->join('users', 'attendance.id', '=', 'users.id') // Assuming NW_Attendance_ID links to users.id
            ->select('users.name', 'attendance.AttendanceDate')
            ->where('attendance.AttendanceStatus_ID', 5)
            ->whereBetween('attendance.AttendanceDate', [$startOfWeek, $endOfWeek])
            ->get();

        // Prepare the details for the stats array
        $details = $attendanceData->groupBy('name')->map(function ($userDates, $userName) {
            $dates = $userDates->map(function ($item) {
                return Carbon::parse($item->AttendanceDate)->format('d/m/Y');
            })->implode(', ');
            return "$userName ($dates)";
        })->values(); // Use values to get a collection of just the strings

        // Add numbering and line breaks using PHP_EOL
        $numberedDetails = $details->map(function ($detail, $index) {
            return ($index + 1) . ". $detail";
        })->implode(PHP_EOL);

        // Prepare the stats array
        $stats = [];

        // Create a single Stat entry for all on leave records
        $stats[] = Stat::make("On leave for the current week", "")
            ->description(($numberedDetails));

        return $stats;
    }
}
