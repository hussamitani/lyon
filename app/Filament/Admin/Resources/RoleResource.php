<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RoleResource\Pages;
use App\Filament\Admin\Resources\RoleResource\RelationManagers\UsersRelationManager;
use App\Models\Permission;
use App\Models\Role;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-finger-print';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        $pimPermissions = Permission::where('key', 'LIKE', 'pim_%')->get();
        $adminPermissions = Permission::where('key', 'LIKE', 'admin_%')->get();
        $settingsPermissions = Permission::where('key', 'LIKE', 'settings_%')->get();

        return $form
            ->schema([
                Forms\Components\Section::make('Role')->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Textarea::make('description')
                        ->maxLength(255),
                ])->columns(1),
                Forms\Components\Section::make('PIM Permissions')->schema([
                    Forms\Components\CheckboxList::make('permissions')
                        ->hiddenLabel()
                        ->relationship('permissions', 'permissions')
                        ->columns(3)
                        ->options($pimPermissions->pluck('name', 'id'))
                        ->descriptions($pimPermissions->pluck('description', 'id')),
                ])->columns(1),
                Forms\Components\Section::make('Settings Permissions')->schema([
                    Forms\Components\CheckboxList::make('permissions')
                        ->hiddenLabel()
                        ->relationship('permissions', 'permissions')
                        ->columns(3)
                        ->options($settingsPermissions->pluck('name', 'id'))
                        ->descriptions($settingsPermissions->pluck('description', 'id')),
                ])->columns(1),
                Forms\Components\Section::make('Administrative Permissions')->schema([
                    Forms\Components\CheckboxList::make('permissions')
                        ->hiddenLabel()
                        ->relationship('permissions', 'permissions')
                        ->columns(3)
                        ->options($adminPermissions->pluck('name', 'id'))
                        ->descriptions($adminPermissions->pluck('description', 'id')),
                ])->columns(1),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('key')
                    ->default(false)
                    ->tooltip(__('Can be renamed, but not deleted'))
                    ->label('Locked')
                    ->trueIcon('heroicon-o-lock-closed')
                    ->falseIcon('heroicon-o-lock-open')
                    ->width(1)
                    ->color('gray'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('users_count')
                    ->alignEnd(),
                Tables\Columns\TextColumn::make('permissions_count')
                    ->alignEnd(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
