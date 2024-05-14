<?php

namespace App\Filament\Manager\Resources;

use App\Filament\Manager\Resources\AttendanceReportResource\Pages;
use App\Filament\Manager\Resources\AttendanceReportResource\RelationManagers;
use App\Models\Attendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttendanceReportResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationGroup = 'Attendances';

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttendanceReports::route('/'),
            'create' => Pages\CreateAttendanceReport::route('/create'),
            'edit' => Pages\EditAttendanceReport::route('/{record}/edit'),
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
