<?php

namespace App\Filament\Resources\PpdbSettings;

use App\Filament\Resources\PpdbSettings\Pages\CreatePpdbSetting;
use App\Filament\Resources\PpdbSettings\Pages\EditPpdbSetting;
use App\Filament\Resources\PpdbSettings\Pages\ListPpdbSettings;
use App\Filament\Resources\PpdbSettings\Pages\ViewPpdbSetting;
use App\Filament\Resources\PpdbSettings\Schemas\PpdbSettingForm;
use App\Filament\Resources\PpdbSettings\Schemas\PpdbSettingInfolist;
use App\Filament\Resources\PpdbSettings\Tables\PpdbSettingsTable;
use App\Models\PpdbSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PpdbSettingResource extends Resource
{
    protected static ?string $model = PpdbSetting::class;

    protected static UnitEnum|string|null $navigationGroup = 'PPDB Online';

    protected static ?string $navigationLabel = 'Pengaturan & Info PPDB';

    protected static ?string $modelLabel = 'Pengaturan PPDB';

    protected static ?string $pluralModelLabel = 'Pengaturan PPDB';

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAdjustmentsHorizontal;

    protected static ?string $recordTitleAttribute = 'academic_year';

    public static function form(Schema $schema): Schema
    {
        return PpdbSettingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PpdbSettingInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PpdbSettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPpdbSettings::route('/'),
            'create' => CreatePpdbSetting::route('/create'),
            'view' => ViewPpdbSetting::route('/{record}'),
            'edit' => EditPpdbSetting::route('/{record}/edit'),
        ];
    }
}
