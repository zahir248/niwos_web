<?php

namespace App\Filament\Manager\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\User;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;

class ManagerWidgets extends BaseWidget
{
    protected function getStats(): array
    {
        // Get the logged-in user's ID
        $userId = Auth::user()->id;

        // Get the logged-in user
        $loggedInUser = Auth::user();

        // Retrieve the department name of the logged-in user
        $departmentName = $loggedInUser->department ? $loggedInUser->department->DepartmentName : 'No Department';

        // Log the department name for debugging
        \Log::info('Department Name: ' . $departmentName);

        // Count total users managed by the logged-in user
        $totalUsers = User::where('Manager_ID', $userId)->count();

        // Count total attendances for users managed by the logged-in user
        $totalAttendances = Attendance::whereHas('user', function ($query) use ($userId) {
            $query->where('Manager_ID', $userId);
        })->count();

        // Count total pending leave requests for users managed by the logged-in user
        $totalPendingRequests = LeaveRequest::whereHas('user', function ($query) use ($userId) {
            $query->where('Manager_ID', $userId);
        })->where('LeaveRequestStatus_ID', 2)->count();

        return [
            Card::make('Total Subordinates', $totalUsers),
            Card::make('Total Attendances', $totalAttendances),
            Card::make('Total Pending Requests', $totalPendingRequests),
            Card::make('Department', $departmentName),
        ];
    }
}
