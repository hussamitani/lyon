<?php

namespace App\Filament\Pdms\Resources;

use App\Filament\Pdms\Resources\ReportResource\Pages\CreateReport;
use App\Filament\Pdms\Resources\ReportResource\Pages\EditReport;
use App\Filament\Pdms\Resources\ReportResource\Pages\ListReports;
use App\Filament\Pdms\Resources\ReportResource\Pages\ViewReport;
use App\Models\Patient;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->getOptionLabelFromRecordUsing(fn (Patient $record) => "$record->qid | {$record->firstname} {$record->lastname}")
                    ->relationship('patient', 'qid')
                    ->searchable(['firstname', 'lastname', 'qid'])
                    ->placeholder('Select a patient')
                    ->searchPrompt('Name or QID')
                    ->getOptionLabelFromRecordUsing(fn (Patient $record) => "$record->qid | {$record->name}")
                    ->required(),
                Forms\Components\TextInput::make('subject')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('files')
                    ->multiple()
                    ->preserveFilenames()
                    /* TODO: Grab patient_id from select above instead of executing another query to the database */
                    /* @phpstan-ignore-next-line */
                    ->directory(fn (Forms\Get $get) => Patient::find($get('patient_id'))->qid)
                    ->downloadable(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient.firstname')
                    ->label('Firstname')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('patient.lastname')
                    ->label('Lastname')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('patient.qid')
                    ->label('QID')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('patient.name')
                    ->prefix(fn (Report $record) => "{$record->patient->qid} | "),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReports::route('/'),
            'create' => CreateReport::route('/create'),
            'view' => ViewReport::route('/{record}'),
            'edit' => EditReport::route('/{record}/edit'),
        ];
    }
}
