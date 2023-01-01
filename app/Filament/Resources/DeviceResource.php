<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeviceResource\Pages;
use App\Models\Device;
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

class DeviceResource extends Resource
{
    protected static ?string $model = Device::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $modelLabel = " الاجهزه ";
    protected static ?string $label = " الاجهزه  ";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('name')
                        ->required()->unique(ignoreRecord: true)
                        ->label("الاسم الجهاز"),
                    Forms\Components\TextInput::make('SN')
                        ->unique(ignoreRecord: true)
                        ->label("SN "),
                    Forms\Components\Select::make('hospital_id')
                        ->label('اختر المشفى')
                        ->options(Hospital::all()->pluck('name', 'id'))
                        ->searchable(),
                    SpatieMediaLibraryFileUpload::make('image')->collection("images")->enableReordering(),
//                    SpatieMediaLibraryFileUpload::make('pdf')->collection("service_manual")->acceptedFileTypes(['pdf']),
                    Forms\Components\Toggle::make('is_active')->default(true)->label("الحاله"),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->label('الاسم'),
                Tables\Columns\TextColumn::make("SN")->label('SN'),
                Tables\Columns\TextColumn::make("created_at")->dateTime("d-m-y")->label("تاريخ الاضافه"),
                Tables\Columns\ToggleColumn::make("is_active")->label('الحاله'),
                SpatieMediaLibraryImageColumn::make('image')->disk('public'),
                SpatieMediaLibraryImageColumn::make('pdf')->disk('public'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListDevices::route('/'),
            'create' => Pages\CreateDevice::route('/create'),
            'edit' => Pages\EditDevice::route('/{record}/edit'),
        ];
    }
}
