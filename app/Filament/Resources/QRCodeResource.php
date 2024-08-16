<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QRCodeResource\Pages;
use App\Filament\Resources\QRCodeResource\RelationManagers;
use App\Models\Attendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QRCodeResource extends Resource
{
    protected static ?string $model = Attendance::class;
    
    protected static ?string $navigationGroup = 'Attendances';

    protected static ?string $navigationIcon = 'heroicon-o-viewfinder-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQRCodes::route('/'),
            'create' => Pages\CreateQRCode::route('/create'),
            'edit' => Pages\EditQRCode::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Attendance QR Code';
    }

    public static function canCreate(): bool
   {
      return false;
 
    }
    
    public static function table(Table $table): Table
{
    return $table
        ->paginated(false);
}
}
