<?php

namespace App\Filament\Resources\DeviceResource\RelationManagers;

use App\Exports\DeviceExport;
use App\Models\Device;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class FixSheetsRelationManager extends RelationManager
{
    protected static string $relationship = 'fixSheets';

    protected static ?string $recordTitleAttribute = 'diagnosis';
    protected static ?string $title = '  تقارير الاصلاح';

    protected static ?string $modelLabel = '  تقارير الاصلاح';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([

                    Forms\Components\TextInput::make('diagnosis')
                        ->required()
                        ->label("التشخيص الاولي"),

                    Forms\Components\TextInput::make('solution')
                        ->label("الاجراء المتبع"),

                    Forms\Components\Textarea::make('description')
                        ->label("شرح "),

                    Forms\Components\Select::make('device_id')
                        ->options(Device::all()->pluck('name', 'id'))->label("الجهاز")
                        ->searchable()->required()
                        ->getSearchResultsUsing(fn(string $search) => Device::
                        where('name', 'like', "%{$search}%")
                            ->limit(50)->pluck('name', 'id'))
                        ->disablePlaceholderSelection()
                        ->placeholder('اختر الجهاز'),


                    Forms\Components\Select::make('user_id')
                        ->options(User::all()->pluck('name', 'id'))->label("فني الصيانه")
                        ->searchable()
                        ->disablePlaceholderSelection()
                        ->placeholder('اختر فني الصيانه'),

                    Forms\Components\Select::make('status')
                        ->options([
                            'Don' => 'تم الاصلاح',
                            'Active' => 'قيد الاصلاح',
                            'Invalid' => 'منسق',
                            'Waiting' => 'في الانتظار',
                        ])->label("الحاله")
                        ->searchable()
                        ->disablePlaceholderSelection()
                        ->placeholder('اختر الحاله')->default('Waiting'),


                    SpatieMediaLibraryFileUpload::make('image')->collection('images')
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("diagnosis")->label("التشخيص الاولي"),
                Tables\Columns\TextColumn::make("status")->label("الحاله ")
                    ->enum([
                        'Don' => 'تم الاصلاح',
                        'Active' => 'قيد الاصلاح',
                        'Invalid' => 'منسق',
                        'Waiting' => 'في الانتظار',
                    ]),
                Tables\Columns\ViewColumn::make('status')->view('tables.columns.status-fix-sheet'),

                SpatieMediaLibraryImageColumn::make('image')->disk('public'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('تصدير لاكسل')->action(function () {

                })->color('success'),
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
