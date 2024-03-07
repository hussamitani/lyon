<?php

namespace App\Filament\Pdms\Resources\ReportResource\Pages;

use App\Concerns\HasInfoListDataSection;
use App\Filament\Pdms\Resources\ReportResource;
use App\Models\Report;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

/**
 * @property-read Report $record
 */
class ViewReport extends ViewRecord
{
    protected static string $resource = ReportResource::class;

    use HasInfoListDataSection;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Components\Grid::make(4)->schema([
                Components\Section::make('Test')->schema([
                    Components\TextEntry::make('patient.name'),
                    Components\TextEntry::make('patient.qid')
                        ->label('QID'),
                    Components\Fieldset::make('Description')->schema([
                        Components\TextEntry::make('description')
                            ->hiddenLabel()
                            ->html(),
                    ]),
                ])
                    ->columns()
                    ->columnSpan(3)
                    ->heading(),
                $this->getInfolistDataSection(),
            ]),
            Components\TextEntry::make('files'),
        ]);
    }

    public function getHeading(): string|Htmlable
    {
        return $this->record->subject;
    }
}
