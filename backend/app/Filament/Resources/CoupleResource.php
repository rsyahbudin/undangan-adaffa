<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoupleResource\Pages;
use App\Filament\Resources\CoupleResource\RelationManagers;
use App\Models\Couple;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CoupleResource extends Resource
{
    protected static ?string $model = Couple::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Couples';

    protected static ?string $modelLabel = 'Couple';

    protected static ?string $pluralModelLabel = 'Couples';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('wedding_id')
                    ->relationship('wedding', 'title')
                    ->required()
                    ->searchable()
                    ->preload(),

                Forms\Components\Section::make('Groom Information')
                    ->schema([
                        Forms\Components\TextInput::make('groom_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('groom_nickname')
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('groom_photo')
                            ->image()
                            ->directory('weddings/couples')
                            ->visibility('public'),
                        Forms\Components\TextInput::make('groom_father_name')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('groom_mother_name')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Bride Information')
                    ->schema([
                        Forms\Components\TextInput::make('bride_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bride_nickname')
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('bride_photo')
                            ->image()
                            ->directory('weddings/couples')
                            ->visibility('public'),
                        Forms\Components\TextInput::make('bride_father_name')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bride_mother_name')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Toggle::make('is_active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('groom_photo')
                    ->circular()
                    ->size(50),
                Tables\Columns\ImageColumn::make('bride_photo')
                    ->circular()
                    ->size(50),
                Tables\Columns\TextColumn::make('wedding.title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('groom_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bride_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListCouples::route('/'),
            'create' => Pages\CreateCouple::route('/create'),
            'edit' => Pages\EditCouple::route('/{record}/edit'),
        ];
    }
}
