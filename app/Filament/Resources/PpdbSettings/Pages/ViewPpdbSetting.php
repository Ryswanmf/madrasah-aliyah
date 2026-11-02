<?php

namespace App\Filament\Resources\PpdbSettings\Pages;

use App\Filament\Resources\PpdbSettings\PpdbSettingResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPpdbSetting extends ViewRecord
{
    protected static string $resource = PpdbSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
