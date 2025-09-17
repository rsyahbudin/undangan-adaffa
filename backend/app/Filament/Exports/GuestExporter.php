<?php

namespace App\Filament\Exports;

use App\Models\Guest;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class GuestExporter extends Exporter
{
    protected static ?string $model = Guest::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('wedding.title'),
            ExportColumn::make('name'),
            ExportColumn::make('email'),
            ExportColumn::make('phone'),
            ExportColumn::make('session'),
            ExportColumn::make('invite_link')
                ->label('Invite Link')
                ->state(function (Guest $record): string {
                    $base = rtrim(config('app.url'), '/');
                    $code = optional($record->wedding)->invitation_code;
                    $name = urlencode($record->name);
                    $session = $record->session;
                    if (!$code || !$name || !$session) {
                        return '-';
                    }
                    return $base . '/invite/' . $code . '/' . $name . '/' . $session;
                }),
            ExportColumn::make('notes'),
            ExportColumn::make('is_active'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your guest export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
