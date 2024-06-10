<?php

namespace App\Filament\Resources\FeedbackListResource\Pages;

use App\Filament\Resources\FeedbackListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeedbackLists extends ListRecords
{
    protected static string $resource = FeedbackListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
