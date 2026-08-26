<?php

namespace App\Filament\Resources\SphereResource\Pages;

use App\Filament\Resources\SphereResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSpheres extends ManageRecords
{
    protected static string $resource = SphereResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}