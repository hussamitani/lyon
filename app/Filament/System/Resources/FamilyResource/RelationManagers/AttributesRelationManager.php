<?php

namespace App\Filament\System\Resources\FamilyResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class AttributesRelationManager extends RelationManager
{
    protected static string $relationship = 'attributes';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('code')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\IconColumn::make('attribute_settings.is_required')
                    ->label(__('Required'))
                    ->trueIcon(function (bool $state): string {
                        return $state ?
                            'heroicon-o-check-circle' :
                            'heroicon-o-x-circle';
                    }),
                Tables\Columns\IconColumn::make('attribute_settings.is_distributable')
                    ->label(' Value per distribution')
                    ->trueIcon(function (bool $state): string {
                        return $state ?
                            'heroicon-o-check-circle' :
                            'heroicon-o-x-circle';
                    }),
                Tables\Columns\IconColumn::make('attribute_settings.is_territorial')
                    ->label(' Value per territory')
                    ->trueIcon(function (bool $state): string {
                        return $state ?
                            'heroicon-o-check-circle' :
                            'heroicon-o-x-circle';
                    })
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //Tables\Actions\CreateAction::make(),
                Tables\Actions\AssociateAction::make()->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\DissociateAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DissociateBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
