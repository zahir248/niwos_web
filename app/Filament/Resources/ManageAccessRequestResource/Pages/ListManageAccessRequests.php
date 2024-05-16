<?php

namespace App\Filament\Resources\ManageAccessRequestResource\Pages;

use App\Filament\Resources\ManageAccessRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListManageAccessRequests extends ListRecords
{
    protected static string $resource = ManageAccessRequestResource::class;

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
