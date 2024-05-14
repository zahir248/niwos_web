<?php

namespace App\Filament\Resources\ManageAccessResource\Pages;

use App\Filament\Resources\ManageAccessResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateManageAccess extends CreateRecord
{
    protected static string $resource = ManageAccessResource::class;

    protected static bool $canCreateAnother = false;

}
