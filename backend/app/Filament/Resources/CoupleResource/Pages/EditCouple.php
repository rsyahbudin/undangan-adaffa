<?php

namespace App\Filament\Resources\CoupleResource\Pages;

use App\Filament\Resources\CoupleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCouple extends EditRecord
{
    protected static string $resource = CoupleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
