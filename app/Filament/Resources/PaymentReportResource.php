<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentReportResource\Pages;
use App\Filament\Resources\PaymentReportResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Payment;

class PaymentReportResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationGroup = 'Payments';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaymentReports::route('/'),
            'create' => Pages\CreatePaymentReport::route('/create'),
            'edit' => Pages\EditPaymentReport::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
   {
      return false;
   }

    public static function getNavigationLabel(): string
    {
        return 'View Reports';
    }

    public static function table(Table $table): Table
{
    return $table
        ->paginated(false);
}

}
