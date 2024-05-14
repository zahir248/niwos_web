<?php

namespace App\Filament\Resources\ManageAccessResource\Pages;

use App\Filament\Resources\ManageAccessResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditManageAccess extends EditRecord
{
    protected static string $resource = ManageAccessResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
