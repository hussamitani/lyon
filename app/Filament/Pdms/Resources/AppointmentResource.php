<?php

namespace App\Filament\Pdms\Resources;

use App\Filament\Pdms\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->getOptionLabelFromRecordUsing(fn (Patient $record) => "$record->qid | {$record->firstname} {$record->lastname}")
                    ->columnSpan(2)
                    ->relationship('patient', 'qid')
                    ->searchable(['firstname', 'lastname', 'qid'])
                    ->placeholder('Select a patient')
                    ->searchPrompt('Name or QID')
                    ->required(),
                Forms\Components\TextInput::make('subject')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type_id')
                    ->relationship('type', 'name')
                    ->label('Appointment Type')
                    ->required(),
                Forms\Components\DateTimePicker::make('begins_at')
                    ->minDate(now()->startOfHour())
                    ->seconds(false)
                    ->minutesStep(5)
                    ->required(),
                Forms\Components\DateTimePicker::make('ends_at')
                    ->minDate(now()->startOfHour())
                    ->seconds(false)
                    ->minutesStep(5)
                    ->required(),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),
                Forms\Components\RichEditor::make('description')
                    ->label('Content')
                    ->columnSpan(2)
                    ->required()
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
                    ->prefix(fn (Appointment $record) => "{$record->patient->qid} | "),
                Tables\Columns\TextColumn::make('begins_at')
                    ->dateTime('d.m.y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('ends_at')
                    ->dateTime('d.m.Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type.name')
                    ->badge()
                    ->alignCenter()
                    ->toggleable()
                    ->color('info')
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
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
            //
        ];
    }

    /**
     * @return Builder<Appointment>
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
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'view' => Pages\ViewAppointment::route('/{record}'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
