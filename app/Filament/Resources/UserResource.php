<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Pages\Actions\Action;

use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = "اداره المستخدمين";
    protected static ?string $label = " المستخدمين  ";
    protected static ?int $navigationSort = -3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('name')
                        ->required()->unique(ignoreRecord: false)
                        ->label("الاسم المشفى"),
                    Forms\Components\TextInput::make('phone')
                        ->required()->unique(ignoreRecord: true)
                        ->label("رقم التواصل "),
                    SpatieMediaLibraryFileUpload::make('image'),
                    Forms\Components\Toggle::make('is_active')->default(true)->label("الحاله"),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->label('الاسم'),
                Tables\Columns\TextColumn::make("email")->label('email')
                    ->icon('heroicon-s-mail')
                    ->iconPosition('before')->copyable()
                    ->copyMessage('تم نسخ الايميل'),
                Tables\Columns\TextColumn::make("created_at")->dateTime("d-m-y")->label("تاريخ الاضافه"),
                Tables\Columns\ToggleColumn::make("is_active")->label('الحاله'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('تعديل'),
                Tables\Actions\DeleteAction::make()->label("حذف"),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
