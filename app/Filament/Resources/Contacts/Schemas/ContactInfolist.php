<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ContactInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('pic_name')
                    ->placeholder('-'),
                TextEntry::make('phone'),
                TextEntry::make('whatsapp'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('address')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('office_hours'),
                TextEntry::make('maps_embed_url')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('maps_link')
                    ->placeholder('-'),
                TextEntry::make('facebook_url')
                    ->placeholder('-'),
                TextEntry::make('instagram_url')
                    ->placeholder('-'),
                TextEntry::make('youtube_url')
                    ->placeholder('-'),
                TextEntry::make('tiktok_url')
                    ->placeholder('-'),
                TextEntry::make('default_wa_message')
                    ->placeholder('-')
                    ->columnSpanFull(),
                IconEntry::make('is_primary')
                    ->boolean(),
                IconEntry::make('is_active')
                    ->boolean(),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
