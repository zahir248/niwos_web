<?php

namespace App\Filament\Resources\PaymentReportResource\Widgets;

use App\Models\Payment;
use Filament\Widgets\ChartWidget;

class PaymentMethodChart extends ChartWidget
{
    protected static ?string $heading = 'Payment Method Distribution Chart';

    //protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $method1Total = Payment::where('Method_ID', 1)->sum('amount');
        $method2Total = Payment::where('Method_ID', 2)->sum('amount');

        return [
            'labels' => ['Credit/Debit', 'Wallet'],
            'datasets' => [
                [
                    'label' => 'Total Amounts (RM)',
                    'data' => [$method1Total, $method2Total],
                    'backgroundColor' => ['#4CAF50', '#FFC107'],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

