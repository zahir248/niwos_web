<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\User;

class UserOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Count the total number of employees in the Software Development department (Department_ID = 1)
        $totalEmployeesSoftwareDevelopment = User::where('Department_ID', 1)->count();
        $totalEmployeesCybersecurity = User::where('Department_ID', 2)->count();
        $totalEmployeesITOperations = User::where('Department_ID', 3)->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalManagers = User::where('role', 'manager')->count();
        $totalStaffs = User::where('role', 'staff')->count();

        return [
            Card::make('IT Operations', $totalEmployeesITOperations),
            Card::make('Software Development', $totalEmployeesSoftwareDevelopment),
            Card::make('Cybersecurity', $totalEmployeesCybersecurity),
            Card::make('Admin', $totalAdmins),
            Card::make('Manager', $totalManagers),
            Card::make('Staff', $totalStaffs),
        ];
    }
}
