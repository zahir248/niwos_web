<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ManageAccessResource\Pages;
use App\Filament\Resources\ManageAccessResource\RelationManagers;
use App\Models\Access;
use App\Models\User;
use App\Models\AccessArea;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DateTimePicker;
use App\Models\DeletedAccessLog;
use Filament\Tables\Filters\SelectFilter;

class ManageAccessResource extends Resource
{
    protected static ?string $model = Access::class;

    protected static ?string $navigationGroup = 'Accesses';

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    public static function form(Form $form): Form
{
    $users = User::all(); // Retrieve all users
    $accessAreas = AccessArea::all(); // Retrieve all access areas

    $userOptions = $users->map(function ($user) {
        return [
            'value' => $user->id,
            'label' => $user->Niwos_ID . ' - ' . $user->name,
        ];
    })->pluck('label', 'value')->toArray();

    $areaOptions = $accessAreas->map(function ($area) {
        return [
            'value' => $area->AccessArea_ID,
            'label' => $area->AreaName,
        ];
    })->pluck('label', 'value')->toArray();

    return $form
        ->schema([
            Forms\Components\Select::make('id')
                ->label('Employee ID')
                ->options($userOptions)
                ->required()
                ->searchable(),
            Forms\Components\Select::make('AccessArea_ID')
                ->label('Area Name')
                ->options($areaOptions)
                ->required()
                ->searchable(),            
            Forms\Components\DateTimePicker::make('StartTimeDate')->label('Start Date & Time')->required(),
            Forms\Components\DateTimePicker::make('EndTimeDate')->label('End Date & Time')->required(),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('User.Niwos_ID')->label('Employee ID')->searchable(),
                Tables\Columns\TextColumn::make('access_area.AreaName')->label('Area Name'),
                Tables\Columns\TextColumn::make('StartTimeDate')->label('Start Date & Time')->searchable(),
                Tables\Columns\TextColumn::make('EndTimeDate')->label('End Date & Time')->searchable(),            
            ])
            ->filters([
                SelectFilter::make('AccessArea_ID')
                ->label('Area Name')
                ->options([
                    '1' => 'Development labs',
                    '2' => 'Server rooms',
                    '3' => 'Meeting rooms',
                    '4' => 'Training rooms',
                ]),            
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function ($record) {
                        DeletedAccessLog::create([
                            'id' => $record->user->id,
                            'AccessArea_ID' => $record->access_area->AccessArea_ID,
                            'StartTimeDate' => $record->StartTimeDate,
                            'EndTimeDate' => $record->EndTimeDate,
                            'Reason' => 'Terminated by administrator',
                        ]);
                    })
                    ->after(function ($record) {
                        $record->delete(); // Delete the record after it has been logged
                    }),
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
            'index' => Pages\ListManageAccesses::route('/'),
            'create' => Pages\CreateManageAccess::route('/create'),
            'edit' => Pages\EditManageAccess::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Manage Accesses';
    }
}
