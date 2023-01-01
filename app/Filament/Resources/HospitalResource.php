<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HospitalResource\Pages;
use App\Filament\Resources\HospitalResource\RelationManagers;
use App\Filament\Resources\HospitalResource\Widgets\HospitalOverview;
use App\Filament\Resources\HospitalResource\Widgets\StatusOverview;
use App\Models\Hospital;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HospitalResource extends Resource
{
    protected static ?string $model = Hospital::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $modelLabel = " المشافي ";
    protected static ?string $label = " المشافي  ";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('name')
                        ->required()->unique(ignoreRecord: true)
                        ->label("الاسم المشفى"),
                    Forms\Components\TextInput::make('phone')
                        ->unique(ignoreRecord: true)
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
                Tables\Columns\TextColumn::make("name")->label("الاسم"),
                Tables\Columns\TextColumn::make("phone")->label("رقم التواصل "),
                SpatieMediaLibraryImageColumn::make('image')->disk('public'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHospitals::route('/'),
            'create' => Pages\CreateHospital::route('/create'),
            'edit' => Pages\EditHospital::route('/{record}/edit'),
        ];
    }
}
