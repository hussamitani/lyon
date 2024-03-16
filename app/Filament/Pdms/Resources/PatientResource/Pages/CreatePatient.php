<?php

namespace App\Filament\Pdms\Resources\PatientResource\Pages;

use App\Filament\Pdms\Resources\PatientResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreatePatient extends CreateRecord
{
    protected static string $resource = PatientResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = Hash::make(Str::random(8));

        return $data;
    }
}
