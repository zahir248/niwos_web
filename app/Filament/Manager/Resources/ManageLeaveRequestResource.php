<?php

namespace App\Filament\Manager\Resources;

use App\Filament\Manager\Resources\ManageLeaveRequestResource\Pages;
use App\Filament\Manager\Resources\ManageLeaveRequestResource\RelationManagers;
use App\Models\LeaveRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Auth;

class ManageLeaveRequestResource extends Resource
{
    protected static ?string $model = LeaveRequest::class;

    protected static ?string $navigationGroup = 'Attendances';

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->label('Employee ID')
                    ->disabled(),
                Forms\Components\DatePicker::make('StartDate')
                ->label('Start Date')
                ->disabled(),
                Forms\Components\DatePicker::make('EndDate')
                ->label('End Date')
                ->disabled(),
                Forms\Components\Textarea::make('Comment')
                ->label('Comment') 
                ->rows(4) 
                ->placeholder('Enter comment here'), 
            Forms\Components\Select::make('LeaveRequestStatus_ID')
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
        ->modifyQueryUsing(function (Builder $query) {
            // Get the logged-in user's ID
            $userId = Auth::user()->id;
            // Join the users table and filter the query to only include rows where Manager_ID matches the logged-in user's ID
            $query->whereHas('user', function (Builder $query) use ($userId) {
                $query->where('Manager_ID', $userId);
            });
        })
            ->columns([
                Tables\Columns\TextColumn::make('NW_LeaveRequest_ID')->label('Request ID')->searchable(),
                Tables\Columns\TextColumn::make('StartDate')->label('Start Date')->searchable(),
                Tables\Columns\TextColumn::make('EndDate')->label('End Date')->searchable(),
                Tables\Columns\TextColumn::make('formatted_duration')->label('Duration')->searchable(),
                Tables\Columns\TextColumn::make('SubmissionTimeDate')->label('Submission Date & Time')->searchable(),
                Tables\Columns\TextColumn::make('Reason')->label('Reason')->searchable(),
                Tables\Columns\TextColumn::make('leave_type.Type')->label('Type'),
                Tables\Columns\TextColumn::make('Comment')->label('Comment'),
                Tables\Columns\TextColumn::make('ResponseTimeDate')->label('Response Date & Time'),
                Tables\Columns\TextColumn::make('User.Niwos_ID')->label('Employee ID')->searchable(),
                Tables\Columns\TextColumn::make('leave_request_status.Status')->label('Status')->searchable(),            ])
            ->filters([
                SelectFilter::make('LeaveRequestStatus_ID')
                ->label('Status')
                ->options([
                    '1' => 'Approved',
                    '2' => 'Pending',
                    '3' => 'Rejected',
                    '4' => 'Cancelled',
                ]), 
                SelectFilter::make('LeaveType_ID')
                ->label('Type')
                ->options([
                    '1' => 'Sick',
                    '2' => 'Vacation',
                    '3' => 'Personal',
                    '4' => 'Maternity',
                ]),             
                ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Response'),
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
            'index' => Pages\ListManageLeaveRequests::route('/'),
            'create' => Pages\CreateManageLeaveRequest::route('/create'),
            'edit' => Pages\EditManageLeaveRequest::route('/{record}/response'),
        ];
    }

    public static function canCreate(): bool
   {
      return false;
   }

   public static function getNavigationLabel(): string
    {
        return 'Manage Leave Requests';
    }
}
