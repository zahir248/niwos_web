<?php

namespace App\Filament\Manager\Resources\IssueWarningResource\Pages;

use App\Filament\Manager\Resources\IssueWarningResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Manager\Resources\IssueWarningResource\Widgets\IssueOverview;

class ListIssueWarnings extends ListRecords
{
    protected static string $resource = IssueWarningResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            IssueOverview::class
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
