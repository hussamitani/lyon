<?php

namespace App\Filament\System\Resources;

use App\Enums\FieldTypeEnum;
use App\Enums\InputFormatEnum;
use App\Filament\System\Resources\AttributeResource\Pages;
use App\Models\Attribute;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AttributeResource extends Resource
{
    protected static ?string $model = Attribute::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(144),
                Forms\Components\TextInput::make('code')
                    ->unique(table: Attribute::class, ignoreRecord: true)
                    ->regex(`[a-z-]+`)
                    ->required()
                    ->maxLength(144),
                Forms\Components\Textarea::make('description')
                    ->maxLength(255)
                    ->columnSpan(2),
                Forms\Components\Select::make('type')
                    ->searchable()
                    ->options(FieldTypeEnum::options())
                    ->required(),
                Forms\Components\Select::make('input_format')
                    ->searchable()
                    ->options(InputFormatEnum::options())
                    ->required(),
                Forms\Components\Toggle::make('is_required')
                    ->default(false)
                    ->inline(false)
                    ->required(),
                Forms\Components\Toggle::make('is_distributable')
                    ->label(__('Value per Channel'))
                    ->default(false)
                    ->inline(false)
                    ->required(),
                Forms\Components\Toggle::make('is_territorial')
                    ->label(__('Value per Territory'))
                    ->default(false)
                    ->inline(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\IconColumn::make('required')
                    ->boolean(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttributes::route('/'),
            'create' => Pages\CreateAttribute::route('/create'),
            'view' => Pages\ViewAttribute::route('/{record}'),
            'edit' => Pages\EditAttribute::route('/{record}/edit'),
        ];
    }
}
