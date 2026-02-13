<?php

namespace App\Filament\Resources\Pages;  // ← this must be the new one

use App\Filament\Resources\ApplicationResource;  // ← updated, no Applications\
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListApplications extends ListRecords
{
    protected static string $resource = ApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}