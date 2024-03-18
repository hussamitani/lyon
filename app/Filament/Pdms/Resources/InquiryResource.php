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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?int $navigationSort = 3;

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
                    ->prefix(fn (Inquiry $record) => "{$record->patient->qid} | "),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type.name')
                    ->color('info')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status.status_category')
                    ->badge()
                    ->default('open')
                    ->formatStateUsing(fn (string $state) => strtoupper($state))
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
                        default => 'heroicon-o-bell',
                    }),
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
                Tables\Filters\TrashedFilter::make()
                    ->visible(Auth::user()->can('forceDeleteAny', [self::$model])),
                Tables\Filters\SelectFilter::make('patient')
                    ->attribute('id')
                    ->getOptionLabelFromRecordUsing(fn (Patient $record) => "$record->qid | {$record->firstname} {$record->lastname}")
                    ->relationship('patient', 'qid')
                    ->placeholder('QID')
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ResponsesRelationManager::class,
        ];
    }

    /**
     * @return Builder<Inquiry>
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->when(Auth::user()->can('deleteAny', [self::$model]), function (Builder $builder) {
                return $builder->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]);
            });
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
