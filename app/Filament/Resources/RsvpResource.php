<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RsvpResource\Pages;
use App\Filament\Resources\RsvpResource\RelationManagers;
use App\Models\Rsvp;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RsvpResource extends Resource
{
    protected static ?string $model = Rsvp::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';
    protected static ?string $navigationLabel = 'RSVP';
    protected static ?string $pluralLabel = 'RSVP';
    protected static ?string $modelLabel = 'RSVP';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('guest_id')
                    ->relationship('guest', 'name')
                    ->required()
                    ->label('Tamu'),

                Forms\Components\Toggle::make('is_attending')->label('Hadir?'),

                // Forms\Components\TextInput::make('attending_count')
                //     ->numeric()
                //     ->label('Jumlah Hadir'),

                Forms\Components\Textarea::make('message')->label('Ucapan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Tamu')->sortable()->searchable(),
                Tables\Columns\IconColumn::make('is_attending')->boolean()->label('Hadir'),
                // Tables\Columns\TextColumn::make('attending_count')->label('Jumlah Hadir'),
                Tables\Columns\TextColumn::make('message')->limit(50)->label('Ucapan'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListRsvps::route('/'),
            'create' => Pages\CreateRsvp::route('/create'),
            'edit' => Pages\EditRsvp::route('/{record}/edit'),
        ];
    }
}
