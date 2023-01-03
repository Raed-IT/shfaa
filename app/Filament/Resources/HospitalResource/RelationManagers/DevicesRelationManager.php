<?php

namespace App\Filament\Resources\HospitalResource\RelationManagers;

use App\Exports\DeviceExport;
use App\Models\Hospital;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
class DevicesRelationManager extends RelationManager
{
    protected static string $relationship = 'devices';
    protected static ?string $title="الاجهزه الموجوده في المشفى";

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
                    SpatieMediaLibraryFileUpload::make('image')
                        ->collection("images")
                        ->responsiveImages()
                        ->enableReordering(),
//                    SpatieMediaLibraryFileUpload::make('pdf')->collection("service_manual")->acceptedFileTypes(['pdf']),
                    Forms\Components\Toggle::make('is_active')
                        ->default(true)->label("الحاله"),
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
                SpatieMediaLibraryImageColumn::make('image')->disk('public'),
                SpatieMediaLibraryImageColumn::make('pdf')->disk('public'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('اضافه جهاز'),
                Tables\Actions\Action::make("سي")->label('تصدير لاكسل')->action(function (){

                })->color('success'),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
