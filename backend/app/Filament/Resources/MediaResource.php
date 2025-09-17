<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Filament\Resources\MediaResource\RelationManagers;
use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Media';

    protected static ?string $modelLabel = 'Media';

    protected static ?string $pluralModelLabel = 'Media';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('wedding_id')
                    ->relationship('wedding', 'title')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('type')
                    ->options(Media::getTypes())
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->maxLength(1000)
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('file_path')
                    ->directory('weddings/media')
                    ->visibility('public')
                    ->acceptedFileTypes(['image/*'])
                    ->hidden(fn($get) => $get('type') === Media::TYPE_PREWEDDING_VIDEO),
                Forms\Components\TextInput::make('file_url')
                    ->url()
                    ->maxLength(255)
                    ->hidden(fn($get) => $get('type') === Media::TYPE_PREWEDDING_VIDEO),
                Forms\Components\TextInput::make('youtube_url')
                    ->url()
                    ->maxLength(255)
                    ->label('YouTube URL')
                    ->helperText('Untuk video, gunakan link YouTube')
                    ->visible(fn($get) => $get('type') === Media::TYPE_PREWEDDING_VIDEO),
                Forms\Components\TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('file_path')
                    ->circular()
                    ->size(50)
                    ->visible(fn($record) => $record && $record->type === Media::TYPE_GALLERY),
                Tables\Columns\TextColumn::make('wedding.title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn(?string $state): string => match ($state) {
                        Media::TYPE_GALLERY => 'success',
                        Media::TYPE_PREWEDDING_VIDEO => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('youtube_url')
                    ->label('YouTube')
                    ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No'),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options(Media::getTypes()),
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
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
        ];
    }
}
