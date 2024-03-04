<?php

namespace App\Filament\System\Resources\InquiryStatusResource\Pages;

use App\Filament\System\Resources\InquiryStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInquiryStatus extends EditRecord
{
    protected static string $resource = InquiryStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
