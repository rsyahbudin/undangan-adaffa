<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RSVPResource\Pages;
use App\Filament\Resources\RSVPResource\RelationManagers;
use App\Models\RSVP;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RSVPResource extends Resource
{
    protected static ?string $model = RSVP::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'RSVPs';

    protected static ?string $modelLabel = 'RSVP';

    protected static ?string $pluralModelLabel = 'RSVPs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('wedding_id')
                    ->relationship('wedding', 'title')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\Select::make('attendance_status')
                    ->options(RSVP::getAttendanceStatuses())
                    ->required(),
                Forms\Components\TextInput::make('guest_count')
                    ->numeric()
                    ->default(1)
                    ->minValue(1),
                Forms\Components\Textarea::make('message')
                    ->maxLength(1000)
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('attendance_date'),
                Forms\Components\Toggle::make('is_confirmed')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('wedding.title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('attendance_status')
                    ->badge()
                    ->color(fn(?string $state): string => match ($state) {
                        'attending' => 'success',
                        'not_attending' => 'danger',
                        'maybe' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('guest_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_confirmed')
                    ->boolean(),
                Tables\Columns\TextColumn::make('attendance_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('attendance_status')
                    ->options(RSVP::getAttendanceStatuses()),
                Tables\Filters\TernaryFilter::make('is_confirmed')
                    ->label('Confirmed Status'),
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
            'index' => Pages\ListRSVPS::route('/'),
            'create' => Pages\CreateRSVP::route('/create'),
            'edit' => Pages\EditRSVP::route('/{record}/edit'),
        ];
    }
}
