<?php

namespace App\Filament\Resources\QRCodeResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\SvgWriter;
use Illuminate\Support\HtmlString;

class QRCodeImage extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        // Generate the QR code
        $qrCode = new QrCode('SD#DevC0d3%trngTg2024!');
        $writer = new SvgWriter();
        $qrCodeSvg = $writer->write($qrCode)->getString();

        // Adjust SVG size by modifying the SVG string
        $qrCodeSvg = str_replace('<svg ', '<svg width="260" height="260" ', $qrCodeSvg);

        // Prepare the stats array
        $stats = [];

        // Create a single Stat entry for the QR code
        $stats[] = Stat::make('QR Code', new HtmlString($qrCodeSvg));

        return $stats;
    }
}
