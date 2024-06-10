<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackListResource\Pages;
use App\Filament\Resources\FeedbackListResource\RelationManagers;
use App\Models\Feedback;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;

class FeedbackListResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Feedback_ID')->label('Feedback ID')->searchable(),
                Tables\Columns\TextColumn::make('Feature.FeatureName'),            
                Tables\Columns\TextColumn::make('Description')->label('Description')->searchable(),
                Tables\Columns\TextColumn::make('Detail')->label('Detail')->searchable(),
                Tables\Columns\TextColumn::make('Impact')->label('Impact')->searchable(),
                Tables\Columns\TextColumn::make('Suggestion')->label('Suggestion')->searchable(),
                Tables\Columns\TextColumn::make('Frequency.FrequencyName')->label('Frequency Rate'),
                Tables\Columns\TextColumn::make('Severity.SeverityName')->label('Severity Rate'), 
                Tables\Columns\TextColumn::make('CreationTimeDate')->label('Creation Date & Time'),   
                Tables\Columns\TextColumn::make('User.Niwos_ID')->label('Employee ID')->searchable(),                
            ])
            ->filters([
                SelectFilter::make('Feature_ID')
                ->label('Feature')
                ->options([
                    '1' => 'User management',
                    '2' => 'Attendance monitoring',
                    '3' => 'Access control management',
                    '4' => 'Payment monitoring',
                ]),
                SelectFilter::make('Frequency_ID')
                ->label('Frequency Rate')
                ->options([
                    '1' => 'Rarely',
                    '2' => 'Occasionally',
                    '3' => 'Frequently',
                ]),     
                SelectFilter::make('Severity_ID')
                ->label('Severity Rate')
                ->options([
                    '1' => 'Low',
                    '2' => 'Medium',
                    '3' => 'High',
                ]),                   
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
            'index' => Pages\ListFeedbackLists::route('/'),
            'create' => Pages\CreateFeedbackList::route('/create'),
            //'edit' => Pages\EditFeedbackList::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'View Feedbacks';
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
