<?php

namespace App\Filament\Pdms\Resources\InquiryResource\Pages;

use App\Concerns\HasInfoListDataSection;
use App\Filament\Pdms\Resources\InquiryResource;
use App\Models\Inquiry;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

/**
 * @property-read Inquiry $record
 */
class ViewInquiry extends ViewRecord
{
    protected static string $resource = InquiryResource::class;

    use HasInfoListDataSection;

    public function getHeading(): string|Htmlable
    {
        return $this->record->subject;
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Grid::make(4)->schema([
                Section::make('Data')->schema([
                    TextEntry::make('patient.name'),
                    TextEntry::make('patient.qid')
                        ->label('QID'),
                    TextEntry::make('type.name')
                        ->badge()
                        ->color('info'),
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
                    Fieldset::make('Description')->schema([
                        TextEntry::make('description')
                            ->columnSpanFull()
                            ->hiddenLabel()
                            ->markdown(),
                    ]),
                ])
                    ->columns()
                    ->columnSpan(3)
                    ->heading(),
                Tabs::make('Author')->schema([
                    $this->getInfolistAuthorTab(),
                    $this->getInfolistVersionsTab([
                        TextEntry::make('subject')->columnSpan(2),
                        TextEntry::make('description')->columnSpan(2),
                        TextEntry::make('type.name')->badge()->columnSpan(2),
                    ]),
                ])
                    ->columnSpan(1)
                    ->columns(2),
            ]),
        ]);
    }
}
