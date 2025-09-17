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

    protected static ?string $navigationLabel = 'Wedding Invitations';

    protected static ?string $modelLabel = 'Wedding Invitation';

    protected static ?string $pluralModelLabel = 'Wedding Invitations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->maxLength(1000)
                            ->columnSpanFull(),
                        Forms\Components\DateTimePicker::make('wedding_date')
                            ->required(),
                        Forms\Components\TextInput::make('invitation_code')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Media')
                    ->schema([
                        Forms\Components\FileUpload::make('cover_photo')
                            ->image()
                            ->directory('weddings/cover')
                            ->visibility('public'),
                        Forms\Components\FileUpload::make('background_photo')
                            ->image()
                            ->directory('weddings/background')
                            ->visibility('public'),
                        Forms\Components\FileUpload::make('background_music')
                            ->acceptedFileTypes(['audio/mpeg', 'audio/mp3', 'audio/wav'])
                            ->directory('weddings/music')
                            ->visibility('public'),
                    ])
                    ->columns(3),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_photo')
                    ->circular()
                    ->size(50),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('invitation_code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('wedding_date')
                    ->dateTime()
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
            'index' => Pages\ListWeddings::route('/'),
            'create' => Pages\CreateWedding::route('/create'),
            'edit' => Pages\EditWedding::route('/{record}/edit'),
        ];
    }
}
