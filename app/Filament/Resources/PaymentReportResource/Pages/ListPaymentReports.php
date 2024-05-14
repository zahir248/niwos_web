<?php

namespace App\Filament\Resources\PaymentReportResource\Pages;

use App\Filament\Resources\PaymentReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PaymentReportResource\Widgets\PaymentMethodChart;
use App\Filament\Resources\PaymentReportResource\Widgets\PaymentLocationChart;

class ListPaymentReports extends ListRecords
{
    protected static string $resource = PaymentReportResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            PaymentMethodChart::class
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            PaymentLocationChart::class
        ];
    }
}
