<?php

namespace App\Filament\Pdms\Resources\InquiryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;

class ResponsesRelationManager extends RelationManager
{
    protected static string $relationship = 'responses';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status_id')
                    ->searchable()
                    ->preload()
                    ->relationship('status', 'status'),
                Forms\Components\RichEditor::make('message')
                    ->required()
                    ->maxLength(255),
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->paginated(false)
            ->recordTitleAttribute('message')
            ->columns([
                Tables\Columns\Layout\Grid::make(['lg' => 12])->schema([
                    Tables\Columns\TextColumn::make('createdBy.name')
                        ->columnSpan(1)
                        ->weight(FontWeight::Bold),
                    Tables\Columns\TextColumn::make('created_at')
                        ->columnSpan(11)
                        ->weight(FontWeight::ExtraLight)
                        ->color(Color::Gray)
                        ->dateTime('d.m.Y H:i:s'),
                    Tables\Columns\TextColumn::make('status.status_category')
                        ->label('Status category')
                        ->formatStateUsing(fn (string $state) => strtoupper($state))
                        ->badge()
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
                            default => 'heroicon-o-bolt',
                        }),
                    Tables\Columns\TextColumn::make('message')
                        ->columnSpan(11)
                        ->html(),
                ])->columnSpan(11),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
            ]);
    }
}
