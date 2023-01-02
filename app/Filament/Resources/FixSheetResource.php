<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FixSheetResource\Pages;
use App\Filament\Resources\FixSheetResource\RelationManagers;
use App\Models\Device;
use App\Models\FixSheet;
use App\Models\Hospital;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;

class FixSheetResource extends Resource
{
    protected static ?string $model = FixSheet::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $modelLabel = " تقارير الاصلاح ";
    protected static ?string $label = " الاجهزه  ";

    public static function form(Form $form): Form
    {
        /*
        diagnosis
        solution
        description
        status
        device_id
        user_id
        */
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
                SpatieMediaLibraryImageColumn::make('image')->disk('public'),
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
            'index' => Pages\ListFixSheets::route('/'),
            'create' => Pages\CreateFixSheet::route('/create'),
            'edit' => Pages\EditFixSheet::route('/{record}/edit'),
        ];
    }
}
