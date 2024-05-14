<?php

namespace App\Filament\Resources\AttendanceReportResource\Pages;

use App\Filament\Resources\AttendanceReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\AttendanceReportResource\Widgets\AttendanceRateChart;
use App\Filament\Resources\AttendanceReportResource\Widgets\AttendanceTrendChart;

class ListAttendanceReports extends ListRecords
{
    protected static string $resource = AttendanceReportResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            AttendanceRateChart::class
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            AttendanceTrendChart::class
        ];
    }


}
