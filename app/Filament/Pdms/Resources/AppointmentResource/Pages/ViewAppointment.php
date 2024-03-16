<?php

namespace App\Filament\Pdms\Resources\AppointmentResource\Pages;

use App\Concerns\HasInfoListDataSection;
use App\Filament\Pdms\Resources\AppointmentResource;
use App\Models\Appointment;
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
 * @property-read Appointment $record
 */
class ViewAppointment extends ViewRecord
{
    use HasInfoListDataSection;

    protected static string $resource = AppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function getHeading(): string|Htmlable
    {
        return $this->record->subject;
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Grid::make(4)->schema([
                Section::make('Appointment')->schema([
                    TextEntry::make('patient.name'),
                    TextEntry::make('patient.qid')
                        ->label('QID'),
                    TextEntry::make('type.name')
                        ->badge()
                        ->color('info'),
                    TextEntry::make('begins_at')
                        ->dateTime('d.m.Y H:i'),
                    TextEntry::make('ends_at')
                        ->dateTime('d.m.Y H:i'),
                    Fieldset::make('Location')->schema([
                        TextEntry::make('location')
                            ->hiddenLabel(),
                    ]),
                    Fieldset::make('Description')->schema([
                        TextEntry::make('description')
                            ->hiddenLabel()
                            ->html(),
                    ]),
                ])
                    ->columns(3)
                    ->heading()
                    ->columnSpan(3),
                Tabs::make('Data')->columns(2)->schema([
                    $this->getInfolistAuthorTab(),
                    $this->getInfolistVersionsTab([
                        TextEntry::make('subject')->columnSpan(2),
                        TextEntry::make('description')->columnSpan(2),
                        TextEntry::make('location')->columnSpan(2),
                        TextEntry::make('begins_at')->columnSpan(1)->dateTime('d.m.Y H:i'),
                        TextEntry::make('ends_at')->columnSpan(1)->dateTime('d.m.Y H:i'),
                    ]),
                ])->columnSpan(1),
            ]),
        ]);
    }
}
