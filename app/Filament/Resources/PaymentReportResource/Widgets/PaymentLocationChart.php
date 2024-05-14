<?php

namespace App\Filament\Resources\PaymentReportResource\Widgets;

use App\Models\Payment;
use Filament\Widgets\ChartWidget;

class PaymentLocationChart extends ChartWidget
{
    protected static ?string $heading = 'Payment Location Comparison Chart';

    //protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $location1Total = Payment::where('Location_ID', 1)->sum('amount');
        $location2Total = Payment::where('Location_ID', 2)->sum('amount');

        return [
            'labels' => ['Cafeteria', 'Vending Machine'],
            'datasets' => [
                [
                    'label' => 'Total Amounts (RM)',
                    'data' => [$location1Total, $location2Total],
                    'backgroundColor' => ['#FF5733', '#3366CC'], // Red and Blue colors
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

