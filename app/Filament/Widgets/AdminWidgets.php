<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Payment;
use App\Models\AccessRequest;

class AdminWidgets extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Card::make('Total Users', User::count()),
            Card::make('Total Attendances', Attendance::count()),
            Card::make('Total Transactions', Payment::count()),
            Card::make('Total Pending Requests', AccessRequest::where('AccessRequestStatus_ID', 2)->count()),
            Card::make('Total Amount', 'RM ' . number_format(Payment::sum('amount'), 2)), // Add new card for total amount
        ];
    }
}
