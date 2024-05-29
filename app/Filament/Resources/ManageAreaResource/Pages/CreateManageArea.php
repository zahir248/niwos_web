<?php

namespace App\Filament\Resources\ManageAreaResource\Pages;

use App\Filament\Resources\ManageAreaResource;
use App\Models\AccessRequestArea; // Import the AccessRequestArea model
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateManageArea extends CreateRecord
{
    protected static string $resource = ManageAreaResource::class;

    protected static bool $canCreateAnother = false;

    protected function afterCreate(): void
    {
        $accessrequestarea = $this->getRecord();

        // Insert data into the AccessRequestArea table
        AccessRequestArea::create([
            'AreaName' => $accessrequestarea->AreaName,
        ]);
    }
}
