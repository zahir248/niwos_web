<?php

namespace App\Filament\Resources\DeletedAccessListResource\Pages;

use App\Filament\Resources\DeletedAccessListResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDeletedAccessList extends CreateRecord
{
    protected static string $resource = DeletedAccessListResource::class;
}
