<?php

namespace App\Filament\System\Resources\InquiryTypeResource\Pages;

use App\Filament\System\Resources\InquiryTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInquiryTypes extends ListRecords
{
    protected static string $resource = InquiryTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
