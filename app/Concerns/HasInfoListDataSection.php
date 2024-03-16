<?php

namespace App\Concerns;

use Filament\Infolists\Components\Component;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Infolists\Components\TextEntry;

trait HasInfoListDataSection
{
    public function getInfolistAuthorTab(): Tab
    {
        return Tab::make('Author')->schema([
            TextEntry::make('createdBy.name'),
            TextEntry::make('created_at')
                ->dateTime('d.m.Y H:i:s'),
            TextEntry::make('updatedBy.name')
                ->visible(fn () => (bool) $this->record->updated_by_id),
            TextEntry::make('updated_at')
                ->visible(fn () => (bool) $this->record->updated_by_id)
                ->dateTime('d.m.Y H:i:s'),
            TextEntry::make('deletedBy.name')
                ->visible(fn () => (bool) $this->record->deleted_by_id),
            TextEntry::make('deleted_at')
                ->visible(fn () => (bool) $this->record->deleted_at)
                ->dateTime('d.m.Y H:i:s'),
        ]);
    }

    /**
     * @param  array<Component>  $trackableTextEntries
     */
    public function getInfolistVersionsTab(array $trackableTextEntries): Tab
    {
        return Tab::make('History')->schema([
            RepeatableEntry::make('versions')->schema([
                ...$trackableTextEntries,
                TextEntry::make('createdBy.name')
                    ->columnSpan(1)
                    ->hidden(fn ($record) => (bool) $record->updated_by_id),
                TextEntry::make('created_at')
                    ->columnSpan(1)
                    ->hidden(fn ($record) => (bool) $record->updated_by_id),
                TextEntry::make('updatedBy.name')
                    ->columnSpan(1)
                    ->visible(fn ($record) => (bool) $record->updated_by_id),
                TextEntry::make('updated_at')
                    ->columnSpan(1)
                    ->visible(fn ($record) => (bool) $record->updated_by_id),
            ])->columns(2)->columnSpan(2)->hiddenLabel(),
        ]);
    }
}
