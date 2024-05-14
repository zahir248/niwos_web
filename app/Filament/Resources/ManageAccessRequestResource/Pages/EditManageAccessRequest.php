<?php

namespace App\Filament\Resources\ManageAccessRequestResource\Pages;

use App\Filament\Resources\ManageAccessRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditManageAccessRequest extends EditRecord
{
    protected static string $resource = ManageAccessRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    public function getTitle(): string
    {
        return 'Access Request Response'; // Change the page title here
    }
}
