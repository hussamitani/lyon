<?php

namespace App\Filament\Pdms\Resources;

use App\Filament\Pdms\Resources\InquiryResource\Pages\CreateInquiry;
use App\Filament\Pdms\Resources\InquiryResource\Pages\EditInquiry;
use App\Filament\Pdms\Resources\InquiryResource\Pages\ListInquiries;
use App\Filament\Pdms\Resources\InquiryResource\Pages\ViewInquiry;
use App\Filament\Pdms\Resources\InquiryResource\RelationManagers\ResponsesRelationManager;
use App\Models\Inquiry;
use App\Models\InquiryType;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->relationship('patient', 'qid')
                    ->searchable(['firstname', 'lastname', 'qid'])
                    ->placeholder('Select a patient')
                    ->searchPrompt('Name or QID')
                    ->getOptionLabelFromRecordUsing(fn (Patient $record) => "$record->qid | {$record->firstname} {$record->lastname}")
                    ->columnSpan(2)
                    ->required(),
                Forms\Components\TextInput::make('subject')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type_id')
                    ->relationship('type', 'id')
                    ->getOptionLabelFromRecordUsing(fn (InquiryType $record) => $record->name)
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\RichEditor::make('description')
                    ->label('Content')
                    ->required()
                    ->columnSpan(2)
                    ->maxLength(255),
            ]);
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
                Tables\Columns\TextColumn::make('type.name')
                    ->numeric()
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ResponsesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInquiries::route('/'),
            'create' => CreateInquiry::route('/create'),
            'view' => ViewInquiry::route('/{record}'),
            'edit' => EditInquiry::route('/{record}/edit'),
        ];
    }
}
