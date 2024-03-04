<?php

namespace App\Filament\System\Resources\InquiryStatusResource\Pages;

use App\Filament\System\Resources\InquiryStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInquiryStatuses extends ListRecords
{
    protected static string $resource = InquiryStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
