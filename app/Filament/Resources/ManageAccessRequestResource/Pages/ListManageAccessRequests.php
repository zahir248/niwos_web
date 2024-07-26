<?php

namespace App\Filament\Resources\ManageAccessRequestResource\Pages;

use App\Filament\Resources\ManageAccessRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ManageAccessRequestResource\Widgets\PendingAccessRequest;

class ListManageAccessRequests extends ListRecords
{
    protected static string $resource = ManageAccessRequestResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            PendingAccessRequest::class
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery()->orderBy('SubmissionTimeDate', 'desc');
    }
}
