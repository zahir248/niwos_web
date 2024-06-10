<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeletedAccessListResource\Pages;
use App\Filament\Resources\DeletedAccessListResource\RelationManagers;
use App\Models\DeletedAccessLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeletedAccessListResource extends Resource
{
    protected static ?string $model = DeletedAccessLog::class;

    protected static ?string $navigationGroup = 'Accesses';

    protected static ?string $navigationIcon = 'heroicon-o-trash';

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
                Tables\Columns\TextColumn::make('access_area.AreaName')->label('Area Name')->searchable(),            
                Tables\Columns\TextColumn::make('StartTimeDate')->label('Start Date & Time')->searchable(),
                Tables\Columns\TextColumn::make('EndTimeDate')->label('End Date & Time')->searchable(),
                Tables\Columns\TextColumn::make('Reason')->label('Reason')->searchable(),
                Tables\Columns\TextColumn::make('User.Niwos_ID')->label('Employee ID')->searchable(),
                ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListDeletedAccessLists::route('/'),
            'create' => Pages\CreateDeletedAccessList::route('/create'),
            //'edit' => Pages\EditDeletedAccessList::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'View Deleted Access';
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
