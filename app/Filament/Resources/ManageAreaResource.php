<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ManageAreaResource\Pages;
use App\Filament\Resources\ManageAreaResource\RelationManagers;
use App\Models\AccessArea;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\SvgWriter;
use Illuminate\Support\HtmlString;

class ManageAreaResource extends Resource
{
    protected static ?string $model = AccessArea::class;

    protected static ?string $navigationGroup = 'Accesses';

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('AreaName')->label('Area Name')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('AreaName')->label('Area')->searchable(),
                Tables\Columns\TextColumn::make('AccessCode')
                    ->label('Access Code')
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        $qrCode = QrCode::create($state);
                        $writer = new SvgWriter();
                        $result = $writer->write($qrCode);

                        // Set the size of the QR code
                        $svg = $result->getString();
                        $svg = str_replace('<svg ', '<svg width="100" height="100" ', $svg);

                        return new HtmlString($svg);
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListManageAreas::route('/'),
            'create' => Pages\CreateManageArea::route('/create'),
            'edit' => Pages\EditManageArea::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Manage Areas';
    }
}
