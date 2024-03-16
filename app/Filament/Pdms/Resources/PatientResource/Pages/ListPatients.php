<?php

namespace App\Filament\Pdms\Resources\PatientResource\Pages;

use App\Filament\Pdms\Resources\PatientResource;
use App\Models\Patient;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Gate;

class ListPatients extends ListRecords
{
    protected static string $resource = PatientResource::class;

    protected function getHeaderActions(): array
    {
        return collect([
            Gate::check('create', Patient::class) ? Actions\CreateAction::make() : null,
        ])->filter()->toArray();
    }
}
