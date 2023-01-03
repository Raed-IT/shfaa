<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeviceResource\Pages;
use App\Filament\Resources\DeviceResource\RelationManagers\FixSheetsRelationManager;
use App\Models\Device;
use App\Models\Hospital;
use App\Models\Section;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

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
                        ->required()
                        ->label("الاسم الجهاز"),
                    Forms\Components\TextInput::make('SN')
                        ->unique(ignoreRecord: true)
                        ->label("SN "),
                    Forms\Components\TextInput::make('count')
                        ->numeric()
                        ->required()
                        ->default(1)->label('العدد'),
                    Forms\Components\TextInput::make('company')
                        ->required()
                        ->label('الشركه المصنعه'),
                    Forms\Components\Select::make('hospital_id')
                        ->label('اختر المشفى')
                        ->options(Hospital::all()->pluck('name', 'id'))
                        ->searchable()->default(function () {
                            return Hospital::find(Setting::find(1)->hospital_id)->id;
                        })
                        ->placeholder('اختر المشفى')
                        ->reactive(),

                    Forms\Components\Select::make('section_id')
                        ->label(' القسم او العياده')
                        ->options(function (callable $get) {
                            if (!$get('hospital_id')) {
                                return [];
                            } else {
                                return Section::where('hospital_id', '=', $get('hospital_id'))->pluck('name', 'id')->toArray();
                            }
                        })->placeholder('اختر القسم او العياده')
                        ->searchable(),

                    SpatieMediaLibraryFileUpload::make('image')
                        ->collection("images")
                        ->image()
                        ->enableReordering(),
                    SpatieMediaLibraryFileUpload::make('pdf')
                        ->collection("service_manual")
                        ->acceptedFileTypes(['pdf']),
                    Forms\Components\Toggle::make('is_active')->default(true)->label("الحاله"),
                ])->columns([
                    'sm' => 1,
                    'lg' => 2,
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->label('الاسم')->searchable(),
                Tables\Columns\TextColumn::make("SN")->label('SN')->searchable()
                    ->copyable()
                    ->copyMessage('تم نسخ ال SN'),
                Tables\Columns\TextColumn::make("created_at")->dateTime("d-m-y")->label("تاريخ الاضافه"),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()->label("الحاله"),
                SpatieMediaLibraryImageColumn::make('image')->disk('public'),

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
            FixSheetsRelationManager::class];
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
