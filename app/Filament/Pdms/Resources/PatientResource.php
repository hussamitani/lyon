<?php

namespace App\Filament\Pdms\Resources;

use App\Filament\Pdms\Resources\PatientResource\Pages;
use App\Filament\Pdms\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('firstname')
                    ->label('Firstname')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lastname')
                    ->label('Lastname')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('qid')
                    ->label('QID')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('birthday')
                    ->required(),
                Radio::make('gender')
                    ->columns(6)
                    ->options([
                        'male' => __('male'),
                        'female' => __('female'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('firstname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('firstname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('qid')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birthday')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn (Patient $record) => \Auth::user()->can('update', $record)),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AppointmentsRelationManager::class,
            RelationManagers\InquiriesRelationManager::class,
            RelationManagers\ReportsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'view' => Pages\ViewPatient::route('/{record}'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
