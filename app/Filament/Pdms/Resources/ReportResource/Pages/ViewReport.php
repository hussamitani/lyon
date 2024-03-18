<?php

namespace App\Filament\Pdms\Resources\ReportResource\Pages;

use App\Concerns\HasInfoListDataSection;
use App\Filament\Pdms\Resources\PatientResource\Pages\ViewPatient;
use App\Filament\Pdms\Resources\ReportResource;
use App\Models\Report;
use App\Providers\Filament\PdmsPanelProvider;
use Filament\Actions\EditAction;
use Filament\Infolists\Components;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

/**
 * @property-read Report $record
 */
class ViewReport extends ViewRecord
{
    use HasInfoListDataSection;

    protected static string $resource = ReportResource::class;

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
            Components\Grid::make(4)->schema([
                Components\Section::make('Test')->schema([
                    Components\TextEntry::make('patient.qid')
                        ->url(ViewPatient::getUrl(['record' => $this->record->patient]))
                        ->color(PdmsPanelProvider::PanelColor)
                        ->prefix($this->record->patient->name.' | '),
                    Components\Fieldset::make('Diagnosis')->schema([
                        Components\TextEntry::make('diagnosis')
                            ->hiddenLabel()
                            ->markdown(),
                    ])->columns(1),
                    Components\Fieldset::make('Treatment')->schema([
                        Components\TextEntry::make('treatment')
                            ->hiddenLabel()
                            ->markdown(),
                    ])->columns(1),
                ])
                    ->columns(2)
                    ->columnSpan(3)
                    ->heading(),
                Tabs::make('Data')->schema([
                    $this->getInfolistAuthorTab(),
                    $this->getInfolistVersionsTab([
                        Components\TextEntry::make('subject')->columnSpan(2),
                        Components\TextEntry::make('diagnosis')->columnSpan(2),
                        Components\TextEntry::make('treatment')->columnSpan(2),
                    ]),
                ])->columns(2),
            ]),
            Components\TextEntry::make('files'),
        ]);
    }
}
