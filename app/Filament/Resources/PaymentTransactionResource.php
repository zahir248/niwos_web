<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentTransactionResource\Pages;
use App\Filament\Resources\PaymentTransactionResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;

class PaymentTransactionResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationGroup = 'Payments';

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('NW_Payment_ID')->label('Payment ID')->searchable(),
            Tables\Columns\TextColumn::make('Amount')->label('Amount (RM)')->searchable(),
            Tables\Columns\TextColumn::make('PaymentTimeDate')->label('Date and Time')->searchable(),
            Tables\Columns\TextColumn::make('method.MethodType')->label('Method'),
            Tables\Columns\TextColumn::make('location.LocationName')->label('Location'),
            Tables\Columns\TextColumn::make('Currency')->label('Currency')->searchable(),
            Tables\Columns\TextColumn::make('User.Niwos_ID')->label('Employee ID')->searchable(),
        ])
        ->filters([
            SelectFilter::make('Method_ID')
                ->label('Method')
                ->options([
                    '1' => 'Credit/Debit',
                    '2' => 'Wallet',
                ]),
        
            SelectFilter::make('Location_ID')
                ->label('Location')
                ->options([
                    '1' => 'Cafeteria',
                    '2' => 'Vending Machine',
                    // Add more options as needed
                ]),        
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                //Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaymentTransaction::route('/'),
            'create' => Pages\CreatePaymentTransaction::route('/create'),
            //'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Monitor Transactions';
    }

    public static function canCreate(): bool
   {
      return false;
   }

}
