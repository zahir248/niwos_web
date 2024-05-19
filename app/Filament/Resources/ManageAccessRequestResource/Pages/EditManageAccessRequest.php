<?php

namespace App\Filament\Resources\ManageAccessRequestResource\Pages;

use App\Filament\Resources\ManageAccessRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Access;

class EditManageAccessRequest extends EditRecord
{
    protected static string $resource = ManageAccessRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTitle(): string
    {
        return 'Access Request Response'; // Change the page title here
    }

    protected function afterSave(): void
    {
        $record = $this->record;

        // Extract necessary data
        $id = $record->id;
        $accessAreaId = $record->AccessRequestArea_ID;
        $startTime = $record->StartTimeDate;
        $endTime = $record->EndTimeDate;

        // Map AccessArea_ID based on AccessRequestArea_ID
        switch ($accessAreaId) {
            case '1':
                $accessAreaId = 3;
                break;
            case '2':
                $accessAreaId = 4;
                break;
            // Add more cases if needed
        }

        // Check if the status is "Approved"
        if ($record->AccessRequestStatus_ID === '1') {
            // Insert data into the Access model
            Access::create([
                'id' => $id,
                'AccessArea_ID' => $accessAreaId,
                'StartTimeDate' => $startTime,
                'EndTimeDate' => $endTime,
            ]);
        }
    }

}
