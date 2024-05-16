<?php

namespace App\Filament\Resources\PaymentTransactionResource\Pages;

use App\Filament\Resources\PaymentTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListPaymentTransaction extends ListRecords
{
    protected static string $resource = PaymentTransactionResource::class;

    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery()
            ->orderBy('PaymentTimeDate', 'desc'); // Order by PaymentTimeDate descending
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
