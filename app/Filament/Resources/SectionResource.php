<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionResource\Pages;
use App\Models\Hospital;
use App\Models\Section;
use App\Models\Setting;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $modelLabel = " الاقسام او العيادات ";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('name')->required()->unique(ignoreRecord: true)->label('الاسم القسم'),
                    Forms\Components\Select::make('hospital_id')
                        ->label('اختر المشفى')
                        ->options(Hospital::all()->pluck('name', 'id'))
                        ->searchable()->default(function () {
                            return Hospital::find(Setting::find(1)->hospital_id)->id;
                        })
                        ->placeholder('اختر المشفى')
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->label('الاسم'),
                Tables\Columns\TextColumn::make("hospital.name")->label('المشفى'),

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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSections::route('/'),
        ];
    }
}
