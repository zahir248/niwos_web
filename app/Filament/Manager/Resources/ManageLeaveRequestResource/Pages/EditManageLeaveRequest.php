<?php

namespace App\Filament\Manager\Resources\ManageLeaveRequestResource\Pages;

use App\Filament\Manager\Resources\ManageLeaveRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditManageLeaveRequest extends EditRecord
{
    protected static string $resource = ManageLeaveRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    public function getTitle(): string
    {
        return 'Leave Request Response'; // Change the page title here
    }
}
