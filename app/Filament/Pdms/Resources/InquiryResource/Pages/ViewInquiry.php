<?php

namespace App\Filament\Pdms\Resources\InquiryResource\Pages;

use App\Filament\Pdms\Resources\InquiryResource;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewInquiry extends ViewRecord
{
    protected static string $resource = InquiryResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            TextEntry::make('patient.name'),
            TextEntry::make('patient.qid')->label('QID'),
            TextEntry::make('type.name'),
            TextEntry::make('subject'),
            TextEntry::make('description')
                ->html(),
            TextEntry::make('status.status_category')
                ->badge()
                ->default('open')
                ->formatStateUsing(fn (string $state) => strtoupper($state))
                ->color(fn (string $state) => match ($state) {
                    'awaiting' => 'warning',
                    'processing' => 'info',
                    'declined' => 'danger',
                    'approved' => 'success',
                    default => 'gray',
                })
                ->icon(fn (string $state) => match ($state) {
                    'awaiting' => 'heroicon-o-question-mark-circle',
                    'processing' => 'heroicon-o-clock',
                    'declined' => 'heroicon-o-x-circle',
                    'approved' => 'heroicon-o-check',
                    default => 'heroicon-o-bell',
                }),
        ]);
    }
}
