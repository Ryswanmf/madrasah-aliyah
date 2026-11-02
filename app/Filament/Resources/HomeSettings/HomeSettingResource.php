<?php

namespace App\Filament\Resources\HomeSettings;

use App\Filament\Resources\HomeSettings\Pages\CreateHomeSetting;
use App\Filament\Resources\HomeSettings\Pages\EditHomeSetting;
use App\Filament\Resources\HomeSettings\Pages\ListHomeSettings;
use App\Filament\Resources\HomeSettings\Pages\ViewHomeSetting;
use App\Filament\Resources\HomeSettings\Schemas\HomeSettingForm;
use App\Filament\Resources\HomeSettings\Schemas\HomeSettingInfolist;
use App\Filament\Resources\HomeSettings\Tables\HomeSettingsTable;
use App\Models\HomeSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class HomeSettingResource extends Resource
{
    protected static ?string $model = HomeSetting::class;

    protected static UnitEnum|string|null $navigationGroup = 'Tampilan & Beranda';

    protected static ?string $navigationLabel = 'Pengaturan Teks & Sambutan';

    protected static ?string $modelLabel = 'Pengaturan Beranda';

    protected static ?string $pluralModelLabel = 'Pengaturan Beranda';

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedComputerDesktop;

    protected static ?string $recordTitleAttribute = 'welcome_title';

    public static function form(Schema $schema): Schema
    {
        return HomeSettingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return HomeSettingInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomeSettingsTable::configure($table);
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
            'index' => ListHomeSettings::route('/'),
            'create' => CreateHomeSetting::route('/create'),
            'view' => ViewHomeSetting::route('/{record}'),
            'edit' => EditHomeSetting::route('/{record}/edit'),
        ];
    }
}
