<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceListResource\Pages;
use App\Models\Attendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class AttendanceListResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationGroup = 'Attendances';

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Form schema
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('NW_Attendance_ID')->label('Attendance ID')->searchable(),
                Tables\Columns\TextColumn::make('shift_session.Session')->label('Session'),
                Tables\Columns\TextColumn::make('AttendanceDate')->label('Date')->searchable(),
                Tables\Columns\TextColumn::make('PunchInTime')->label('Arrival Time')->searchable(),
                Tables\Columns\TextColumn::make('PunchOutTime')->label('Departure Time')->searchable(),
                Tables\Columns\TextColumn::make('User.department.DepartmentName')->label('Department')->searchable(),
                Tables\Columns\TextColumn::make('User.Niwos_ID')->label('Employee ID')->searchable(),
                Tables\Columns\TextColumn::make('attendance_status.Status')->label('Status'),
            ])
            ->filters([
                SelectFilter::make('ShiftSession_ID')
                    ->label('Session')
                    ->options([
                        '1' => 'In',
                        '2' => 'Out',
                    ]),
                SelectFilter::make('AttendanceStatus_ID')
                    ->label('Status')
                    ->options([
                        '1' => 'On time',
                        '2' => 'Late',
                        '3' => 'Too early',
                    ]),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Relations
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttendancesList::route('/'),
            'create' => Pages\CreateAttendanceList::route('/create'),
            // 'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationLabel(): string
    {
        return 'Monitor Attendances';
    }
}
