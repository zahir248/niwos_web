<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ManageAccessRequestResource\Pages;
use App\Models\AccessRequest;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use App\Models\UserAccessArea; 

class ManageAccessRequestResource extends Resource
{
    protected static ?string $model = AccessRequest::class;

    protected static ?string $navigationGroup = 'Accesses';

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->label('Employee ID')
                    ->disabled(),
                Forms\Components\TextInput::make('AccessRequestArea_ID')
                    ->label('Area Name')
                    ->disabled(),
                Forms\Components\DateTimePicker::make('StartTimeDate')
                    ->label('Start Date & Time')
                    ->disabled(),
                Forms\Components\DateTimePicker::make('EndTimeDate')
                    ->label('End Date & Time')
                    ->disabled(),
                Forms\Components\Textarea::make('Comment')
                    ->label('Comment')
                    ->rows(4)
                    ->placeholder('Enter comment here'),
                Forms\Components\Select::make('AccessRequestStatus_ID')
                    ->label('Status')
                    ->options([
                        '1' => 'Approved',
                        '3' => 'Rejected',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('NW_AccessRequest_ID')->label('Request ID')->searchable(),
                Tables\Columns\TextColumn::make('StartTimeDate')->label('Start Date & Time')->searchable(),
                Tables\Columns\TextColumn::make('EndTimeDate')->label('End Date & Time')->searchable(),
                Tables\Columns\TextColumn::make('formatted_duration')->label('Duration')->searchable(),
                Tables\Columns\TextColumn::make('SubmissionTimeDate')->label('Submission Date & Time')->searchable(),
                Tables\Columns\TextColumn::make('Reason')->label('Reason')->searchable(),
                Tables\Columns\TextColumn::make('access_request_area.AreaName')->label('Area Name'),
                Tables\Columns\TextColumn::make('Comment')->label('Comment'),
                Tables\Columns\TextColumn::make('ResponseTimeDate')->label('Response Date & Time'),
                Tables\Columns\TextColumn::make('User.Niwos_ID')->label('Employee ID')->searchable(),
                Tables\Columns\TextColumn::make('access_request_status.Status')->label('Status')->searchable(),
            ])
            ->filters([
                SelectFilter::make('AccessRequestStatus_ID')
                    ->label('Status')
                    ->options([
                        '1' => 'Approved',
                        '2' => 'Pending',
                        '3' => 'Rejected',
                        '4' => 'Cancelled',
                    ]),
                SelectFilter::make('AccessRequestArea_ID')
                    ->label('Area Name')
                    ->options([
                        '1' => 'Meeting rooms',
                        '2' => 'Training rooms',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Response'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListManageAccessRequests::route('/'),
            'create' => Pages\CreateManageAccessRequest::route('/create'),
            'edit' => Pages\EditManageAccessRequest::route('/{record}/response'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationLabel(): string
    {
        return 'Manage Requests';
    }
}
