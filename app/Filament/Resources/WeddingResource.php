<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeddingResource\Pages;
use App\Filament\Resources\WeddingResource\RelationManagers;
use App\Models\Wedding;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WeddingResource extends Resource
{
    protected static ?string $model = Wedding::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $navigationLabel = 'Wedding';
    protected static ?string $pluralModelLabel = 'Weddings';
    protected static ?string $modelLabel = 'Wedding';

    public static function form(Form $form): Form
    {
        return $form->schema([

            // Bride
            Forms\Components\Section::make('Bride')
                ->schema([
                    Forms\Components\TextInput::make('bride_name')
                        ->required()
                        ->label('Full Name'),
                    Forms\Components\TextInput::make('bride_nickname')
                        ->label('Nickname'),
                    Forms\Components\FileUpload::make('bride_photo')
                        ->image()
                        ->directory('weddings/photos')
                        ->label('Photo'),
                    Forms\Components\TextInput::make('bride_father_name')
                        ->label("Father's Name"),
                    Forms\Components\TextInput::make('bride_mother_name')
                        ->label("Mother's Name"),
                ])
                ->columns(2),

            // Groom
            Forms\Components\Section::make('Groom')
                ->schema([
                    Forms\Components\TextInput::make('groom_name')
                        ->required()
                        ->label('Full Name'),
                    Forms\Components\TextInput::make('groom_nickname')
                        ->label('Nickname'),
                    Forms\Components\FileUpload::make('groom_photo')
                        ->image()
                        ->directory('weddings/photos')
                        ->label('Photo'),
                    Forms\Components\TextInput::make('groom_father_name')
                        ->label("Father's Name"),
                    Forms\Components\TextInput::make('groom_mother_name')
                        ->label("Mother's Name"),
                ])
                ->columns(2),

            // Akad
            Forms\Components\Section::make('Akad')
                ->schema([
                    Forms\Components\DatePicker::make('akad_date')
                        ->required()
                        ->label('Date')
                        ->required(),
                    Forms\Components\TimePicker::make('akad_start_time')
                        ->label('Start Time')
                        ->required()
                        ->seconds(false),
                    Forms\Components\TimePicker::make('akad_end_time')
                        ->label('End Time')
                        ->seconds(false),
                    Forms\Components\TextInput::make('akad_place')
                        ->required()
                        ->label('Place'),
                ])
                ->columns(2),

            // Reception 1
            Forms\Components\Section::make('Reception 1')
                ->schema([
                    Forms\Components\DatePicker::make('reception1_date')
                        ->label('Date'),
                    Forms\Components\TimePicker::make('reception1_start_time')
                        ->label('Start Time')
                        ->seconds(false),
                    Forms\Components\TimePicker::make('reception1_end_time')
                        ->label('End Time')
                        ->seconds(false),
                    Forms\Components\TextInput::make('reception1_place')
                        ->label('Place'),
                ])
                ->columns(2),

            // Reception 2
            Forms\Components\Section::make('Reception 2')
                ->schema([
                    Forms\Components\DatePicker::make('reception2_date')
                        ->label('Date'),
                    Forms\Components\TimePicker::make('reception2_start_time')
                        ->label('Start Time')
                        ->seconds(false),
                    Forms\Components\TimePicker::make('reception2_end_time')
                        ->label('End Time')
                        ->seconds(false),
                    Forms\Components\TextInput::make('reception2_place')
                        ->label('Place'),
                ])
                ->columns(2),

            // Maps
            Forms\Components\Section::make('Location')
                ->schema([
                    Forms\Components\TextInput::make('maps_url')
                        ->url()
                        ->label('Google Maps URL'),
                ]),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bride_name')
                    ->sortable()
                    ->searchable()
                    ->label('Bride'),
                Tables\Columns\TextColumn::make('groom_name')
                    ->sortable()
                    ->searchable()
                    ->label('Groom'),
                Tables\Columns\TextColumn::make('akad_date')
                    ->date('d M Y')
                    ->label('Akad Date'),
                Tables\Columns\TextColumn::make('akad_place')
                    ->limit(20)
                    ->label('Akad Place'),
                Tables\Columns\TextColumn::make('reception1_date')
                    ->date('d M Y')
                    ->label('Reception 1'),
                Tables\Columns\TextColumn::make('reception2_date')
                    ->date('d M Y')
                    ->label('Reception 2'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListWeddings::route('/'),
            'create' => Pages\CreateWedding::route('/create'),
            'edit' => Pages\EditWedding::route('/{record}/edit'),
        ];
    }
}
