<?php

namespace App\Filament\Manager\Resources\IssueWarningResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class IssueOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('*Notes', '') // Provide a placeholder value
                ->description('if an employee is late or absent for more than 10% of their total working days, they may receive a warning letter.')
        ];
    }
}
