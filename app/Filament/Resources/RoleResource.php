<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Spatie\Permission\Models\Role;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;
    protected static ?string $navigationGroup = "اداره المستخدمين";
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $modelLabel = 'الادوار ';
    protected static ?int $navigationSort = -2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('name')->required()->unique(ignoreRecord: true)->label('الاسم '),
                    Forms\Components\CheckboxList::make('permissions')
                        ->relationship("permissions", "name")
                        ->columns(3)
                        ->unique()->required()
                        ->label("الصلاحيات"),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->label("الاسم"),
                Tables\Columns\TextColumn::make("created_at")->dateTime("d-m-y"),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label("تعديل"),
                Tables\Actions\DeleteAction::make()->label("حذف"),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
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
