<?php

namespace App\Filament\Resources\ManageAccessRequestResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\AccessRequest;

class PendingAccessRequest extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Card::make('Pending Requests', AccessRequest::where('AccessRequestStatus_ID', 2)->count()),

        ];
    }
}
