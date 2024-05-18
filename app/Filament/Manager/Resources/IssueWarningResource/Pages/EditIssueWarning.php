<?php

namespace App\Filament\Manager\Resources\IssueWarningResource\Pages;

use App\Filament\Manager\Resources\IssueWarningResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIssueWarning extends EditRecord
{
    protected static string $resource = IssueWarningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
