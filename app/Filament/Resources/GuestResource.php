<?php

namespace App\Filament\Resources;

use App\Filament\Exports\GuestExporter;
use App\Filament\Imports\GuestImporter;
use App\Filament\Resources\GuestResource\Pages;
use App\Filament\Resources\GuestResource\RelationManagers;
use App\Models\Guest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ImportAction;


class GuestResource extends Resource
{
    protected static ?string $model = Guest::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Guests';
    protected static ?string $pluralLabel = 'Guests';
    protected static ?string $modelLabel = 'Guest';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('wedding_id')
                    ->relationship('wedding', 'bride_name')
                    ->required()
                    ->label('Acara'),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nama Tamu'),

                Forms\Components\TextInput::make('phone')->label('No HP'),
                Forms\Components\TextInput::make('email')->label('Email'),

                Forms\Components\Select::make('session')
                    ->options([
                        1 => 'Sesi 1 (Akad + Resepsi 1)',
                        2 => 'Sesi 2 (Akad + Resepsi 2)',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('guest_count')
                    ->numeric()
                    ->default(1)
                    ->label('Jumlah Undangan'),

                Forms\Components\Toggle::make('is_invited')->default(true)->label('Diundang?'),
                Forms\Components\Toggle::make('is_active')->default(true)->label('Aktif?'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('session')
                    ->formatStateUsing(fn ($state) => $state == 1 ? 'Sesi 1' : 'Sesi 2'),
                Tables\Columns\TextColumn::make('guest_count')->label('Quota'),
                Tables\Columns\TextColumn::make('invitation_url')->label('URL Undangan'),

            ])
            ->headerActions([
                ImportAction::make()->importer(GuestImporter::class)->label('Import Guest'),
                ExportAction::make()->exporter(GuestExporter::class)->label('Export Guest'),
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
            'index' => Pages\ListGuests::route('/'),
            'create' => Pages\CreateGuest::route('/create'),
            'edit' => Pages\EditGuest::route('/{record}/edit'),
        ];
    }
}
