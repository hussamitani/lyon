<?php

namespace App\Filament\Settings\Resources\FamilyResource\Pages;

use App\Filament\Settings\Resources\FamilyResource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateFamily extends CreateRecord
{
    protected static string $resource = FamilyResource::class;

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name'),
        ]);
    }
}
