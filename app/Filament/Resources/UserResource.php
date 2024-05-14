<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        $managers = User::where('role', 'manager')->with('department')->get();

        $managerOptions = $managers->map(function ($manager) {
            $nameWithDept = $manager->name . ' - ' . $manager->department->DepartmentName;
            return [
                'id' => $manager->id,
                'name' => $nameWithDept,
            ];
        })->pluck('name', 'id')->toArray();

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('Full Name')->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('PhoneNumber')->label('Phone Number')->required(),
                Forms\Components\DatePicker::make('DateOfBirth')->label('Date of Birth')->required(),
                Forms\Components\FileUpload::make('SecurityImage')->label('Security Image')->disabled(), // Disabled SecurityImage field
                Forms\Components\FileUpload::make('ProfileImage')->label('Profile Image')->disabled(), // Disabled ProfileImage field
                Forms\Components\DatePicker::make('StartDate')->label('Start work at')->required(),
                Forms\Components\Select::make('role')
                    ->label('Role')
                    ->options([
                        'staff' => 'Staff',
                        'manager' => 'Manager',
                        'admin' => 'Administrator',
                    ])
                    ->required(),
                Forms\Components\Select::make('Department_ID')
                    ->label('Department')
                    ->options([
                        1 => 'Software Development',
                        2 => 'Cybersecurity',
                        3 => 'IT Operations',
                    ])
                    ->required(),
                Forms\Components\Select::make('Position_ID')
                    ->label('Position')
                    ->options([
                        1 => 'Software Engineer',
                        2 => 'Security Analyst',
                        3 => 'Development Manager',
                        4 => 'Security Manager',
                        5 => 'Director of IT Operations',
                    ])
                    ->required(),
                Forms\Components\Select::make('Manager_ID')
                    ->label('Manager')
                    ->options($managerOptions)
                    ->searchable(),
                Forms\Components\Select::make('AccountStatus_ID')
                ->label('Status')
                ->options([
                    '1' => 'Active',
                    '2' => 'Inactive',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Niwos_ID')->label('Employee ID')->searchable(),
                Tables\Columns\TextColumn::make('name')->label('Full Name')->searchable(),
                Tables\Columns\TextColumn::make('position.PositionName')->label('Position'),
                Tables\Columns\TextColumn::make('department.DepartmentName')->label('Department'),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('PhoneNumber')->label('Phone Number')->searchable(),
                Tables\Columns\TextColumn::make('StartDate')->label('Start Work')->searchable(),
                Tables\Columns\TextColumn::make('DateOfBirth')->label('Date of Birth')->searchable(),
                Tables\Columns\TextColumn::make('manager.name')->label('Name of Manager'), // Accessing manager's FullName
                Tables\Columns\TextColumn::make('role')->label('Role'),
                Tables\Columns\TextColumn::make('account_status.Status')->label('Status'),
            ])
            ->filters([
                SelectFilter::make('Department_ID')
                ->label('Department')
                ->options([
                    '1' => 'Software Development',
                    '2' => 'Cybersecurity',
                    '3' => 'IT Operations',
                ]),
                SelectFilter::make('Position_ID')
                ->label('Position')
                ->options([
                    '1' => 'Software Engineer',
                    '2' => 'Security Analyst',
                    '3' => 'Development Manager',
                    '4' => 'Security Manager',
                    '5' => 'Director of IT Operations',
                ]),
                SelectFilter::make('role')
                ->label('Role')
                ->options([
                    'admin' => 'admin',
                    'manager' => 'manager',
                    'staff' => 'staff',
                ]),
                SelectFilter::make('AccountStatus_ID')
                ->label('Status')
                ->options([
                    '1' => 'Active',
                    '2' => 'Inactive',
                ]),            
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
