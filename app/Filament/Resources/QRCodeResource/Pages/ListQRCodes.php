<?php

namespace App\Filament\Resources\QRCodeResource\Pages;

use App\Filament\Resources\QRCodeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\QRCodeResource\Widgets\QRCodeImage;


class ListQRCodes extends ListRecords
{
    protected static string $resource = QRCodeResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            QRCodeImage::class,
        ];
    }

}
