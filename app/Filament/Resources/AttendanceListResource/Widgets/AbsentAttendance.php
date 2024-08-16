<?php

namespace App\Filament\Resources\AttendanceListResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AbsentAttendance extends BaseWidget
{
    protected function getStats(): array
    {
        // Get the start and end dates for the last completed week
        $startOfLastWeek = Carbon::now()->startOfWeek(Carbon::MONDAY)->subWeek();
        $endOfLastWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY)->subWeek();

        // Generate an array of dates for the last week
        $lastWeekDates = [];
        $date = $startOfLastWeek->copy();
        while ($date->lte($endOfLastWeek)) {
            $lastWeekDates[] = $date->format('Y-m-d');
            $date->addDay();
        }

        // Fetch all users
        $allUsers = DB::table('users')->select('id', 'name')->get();

        // Fetch users who have attendance records for the last week
        $attendanceRecords = DB::table('attendance')
            ->join('users', 'attendance.id', '=', 'users.id')
            ->select('users.id', 'users.name', 'attendance.AttendanceDate')
            ->whereBetween('attendance.AttendanceDate', [$startOfLastWeek->format('Y-m-d'), $endOfLastWeek->format('Y-m-d')])
            ->get();

        // Group attendance records by user ID
        $attendanceByUser = $attendanceRecords->groupBy('id');

        // Determine absent dates for each user
        $absentUsers = $allUsers->map(function ($user) use ($attendanceByUser, $lastWeekDates) {
            $attendanceDates = isset($attendanceByUser[$user->id]) 
                ? $attendanceByUser[$user->id]->pluck('AttendanceDate')->toArray() 
                : [];

            // Find dates where the user was absent
            $absentDates = array_diff($lastWeekDates, $attendanceDates);

            if (!empty($absentDates)) {
                $formattedDates = implode(', ', array_map(function ($date) {
                    return Carbon::parse($date)->format('d/m/Y');
                }, $absentDates));
                return $user->name . " (" . $formattedDates . ")";
            }

            return null;
        })->filter()->values(); // Remove null values and reindex

        // Add numbering and line breaks
        $numberedDetails = $absentUsers->map(function ($detail, $index) {
            return ($index + 1) . ". $detail";
        })->implode(PHP_EOL);

        // Prepare the stats array
        $stats = [];

        // Create a single Stat entry for all absent users
        $stats[] = Stat::make("Absent for the last week (without reason)", "")
            ->description(($numberedDetails));

        return $stats;
    }
}
