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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
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
                    ->directory(fn (Forms\Get $get) => Patient::find($get('patient_id'))->qid)
                    ->downloadable(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
