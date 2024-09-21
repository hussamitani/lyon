<?php

namespace App\Filament\Settings\Resources\FamilyResource\RelationManagers;

use App\Models\Attribute;
use App\Models\Family;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

/**
 * @property Family $ownerRecord
 */
class AttributesRelationManager extends RelationManager
{
    protected static string $relationship = 'attributes';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('attributes')
                    ->multiple() // Allows selecting multiple attributes
                    ->relationship('attributes', 'name') // Defines the relationship
                    ->preload() // Preloads attributes for better performance
                    ->required()
                    ->searchable(), // Makes the select searchable
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('code')
            ->defaultSort('order')
            ->reorderable('order')
            ->columns([
                TextColumn::make('order')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\IconColumn::make('settings.is_distributable')
                    ->label(' Value per distribution')
                    ->trueIcon(function (bool $state): string {
                        return $state ?
                            'heroicon-o-check-circle' :
                            'heroicon-o-x-circle';
                    }),
                Tables\Columns\IconColumn::make('settings.is_territorial')
                    ->label(' Value per territory')
                    ->trueIcon(function (bool $state): string {
                        return $state ?
                            'heroicon-o-check-circle' :
                            'heroicon-o-x-circle';
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordSelect(fn () => Select::make('recordId'))
                    ->label('Attach')
                    ->modalHeading('Attach Attribute to Family')
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        Forms\Components\Select::make('recordId')
                            ->label('Attribute')
                            ->options(Attribute::query()->whereNotIn('id', $this->ownerRecord->attributes->pluck('id'))->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                    ]),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
