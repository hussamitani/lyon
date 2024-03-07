<?php

namespace App\Concerns;

use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Infolists\Components\TextEntry;

trait HasInfoListDataSection
{
    public function getInfolistDataSection(): Tabs
    {
        return Tabs::make('Data')->tabs([
            Tab::make('Author')->schema([
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
            ]),
            Tab::make('History')->schema([
                TextEntry::make('')
                    ->label('Versioning')
                    ->default('Coming Soon'),
            ]),
        ])->columns(2)->columnSpan(1);
    }
}
