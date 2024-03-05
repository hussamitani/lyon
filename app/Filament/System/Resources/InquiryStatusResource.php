<?php

namespace App\Filament\System\Resources;

use App\Filament\System\Resources\InquiryStatusResource\Pages;
use App\Models\InquiryStatus;
use Filament\Forms;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Table;

class InquiryStatusResource extends Resource
{
    protected static ?string $model = InquiryStatus::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255),
                ToggleButtons::make('status_category')
                    ->label('Status Category')
                    ->inline()
                    ->colors([
                        'processing' => 'info',
                        'awaiting' => 'warning',
                        'declined' => 'danger',
                        'approved' => 'success',
                    ])
                    ->options([
                        'processing' => 'Processing',
                        'awaiting' => 'Awaiting',
                        'declined' => 'Declined',
                        'approved' => 'Approved',
                    ])
                    ->icons([
                        'processing' => 'heroicon-o-clock',
                        'awaiting' => 'heroicon-o-question-mark-circle',
                        'declined' => 'heroicon-o-x-circle',
                        'approved' => 'heroicon-o-check',
                    ]),
                Forms\Components\Textarea::make('description')
                    ->columnSpan(2)
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_category')
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
                        default => 'heroicon-o-bolt',
                    })
                    ->tooltip(fn (InquiryStatus $record) => $record->description)

                    ->badge()
                    ->iconPosition(IconPosition::After),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListInquiryStatuses::route('/'),
            'create' => Pages\CreateInquiryStatus::route('/create'),
            'edit' => Pages\EditInquiryStatus::route('/{record}/edit'),
        ];
    }
}
