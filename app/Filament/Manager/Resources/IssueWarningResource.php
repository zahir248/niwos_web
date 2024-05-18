<?php

namespace App\Filament\Manager\Resources;

use App\Filament\Manager\Resources\IssueWarningResource\Pages;
use App\Filament\Manager\Resources\IssueWarningResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Auth;

class IssueWarningResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Attendances';

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('email')
                    ->label('Subordinates')
                    ->options(function () {
                        return User::where('Manager_ID', Auth::id())
                            ->get()
                            ->mapWithKeys(function ($user) {
                                return [$user->email => $user->Niwos_ID . ' - ' . $user->name . ' - ' . $user->email];
                            })
                            ->toArray();
                    })
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->modifyQueryUsing(function (Builder $query) {
                $userId = Auth::user()->id;
                $query->where('Manager_ID', $userId); // Assuming Manager_ID is the column name
            })
            ->columns([
                Tables\Columns\TextColumn::make('Niwos_ID')->label('Employee ID')->searchable(),
                Tables\Columns\TextColumn::make('name')->label('Full Name')->searchable(),
                Tables\Columns\TextColumn::make('position.PositionName')->label('Position'),
                Tables\Columns\TextColumn::make('late_percentage')->label('Late or Absent'),
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
            'index' => Pages\ListIssueWarnings::route('/'),
            'create' => Pages\CreateIssueWarning::route('/create'),
            //'edit' => Pages\EditIssueWarning::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Issue Warning Letters';
    }
}