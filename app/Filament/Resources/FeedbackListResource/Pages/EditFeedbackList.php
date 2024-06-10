<?php

namespace App\Filament\Resources\FeedbackListResource\Pages;

use App\Filament\Resources\FeedbackListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFeedbackList extends EditRecord
{
    protected static string $resource = FeedbackListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
