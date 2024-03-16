<?php

namespace App\Filament\System\Resources;

use App\Filament\System\Resources\InquiryTypeResource\Pages;
use App\Models\InquiryType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InquiryTypeResource extends Resource
{
    protected static ?string $model = InquiryType::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('Inquiry type'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->maxLength(255),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('key')
                    ->tooltip(__('Can be renamed, but not deleted'))
                    ->label('Locked')
                    ->default(false)
                    ->trueIcon('heroicon-o-lock-closed')
                    ->falseIcon('heroicon-o-lock-open')
                    ->width(1)
                    ->color('gray'),
                Tables\Columns\TextColumn::make('name')
                    ->tooltip(fn (InquiryType $record) => $record->description)
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
            'index' => Pages\ListInquiryTypes::route('/'),
            'create' => Pages\CreateInquiryType::route('/create'),
            'edit' => Pages\EditInquiryType::route('/{record}/edit'),
        ];
    }
}
