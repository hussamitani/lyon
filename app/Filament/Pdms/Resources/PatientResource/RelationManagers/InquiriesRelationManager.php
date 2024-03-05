<?php

namespace App\Filament\Pdms\Resources\PatientResource\RelationManagers;

use App\Models\InquiryStatus;
use App\Models\InquiryType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class InquiriesRelationManager extends RelationManager
{
    protected static string $relationship = 'inquiries';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('subject')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('subject')
            ->columns([
                Tables\Columns\TextColumn::make('subject'),
                Tables\Columns\TextColumn::make('type')
                    ->formatStateUsing(fn (InquiryType $state) => $state->name)
                    ->tooltip(fn (InquiryType $state) => $state->description)
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->default('open')
                    ->formatStateUsing(fn (InquiryStatus $state) => strtoupper($state->status_category))
                    ->tooltip(fn (InquiryStatus $state) => $state->status)
                    ->color(fn (InquiryStatus $state) => match ($state->status_category) {
                        'awaiting' => 'warning',
                        'processing' => 'info',
                        'declined' => 'danger',
                        'approved' => 'success',
                        default => 'gray',
                    })
                    ->icon(fn (InquiryStatus $state) => match ($state->status_category) {
                        'awaiting' => 'heroicon-o-question-mark-circle',
                        'processing' => 'heroicon-o-clock',
                        'declined' => 'heroicon-o-x-circle',
                        'approved' => 'heroicon-o-check',
                        default => 'heroicon-o-bell',
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
