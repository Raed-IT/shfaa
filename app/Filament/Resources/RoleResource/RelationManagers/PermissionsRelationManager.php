<?php

namespace App\Filament\Resources\RoleResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Label;

class PermissionsRelationManager extends RelationManager
{
    protected static string $relationship = 'permissions';

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $modelLabel="الصلاحيات";
    protected static ?string $title="الصلاحيات الحاليه";
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()->label("الاسم")
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->label("الاسم"),
                Tables\Columns\TextColumn::make("created_at")->dateTime("d-m-y")->label("تاريخ الانشاء"),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label("اضف صلاحيه جديده"),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label("تعديل"),
                Tables\Actions\DeleteAction::make()->label("حذف"),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
