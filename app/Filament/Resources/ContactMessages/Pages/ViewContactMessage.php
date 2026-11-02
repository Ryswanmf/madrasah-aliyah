<?php

namespace App\Filament\Resources\ContactMessages\Pages;

use App\Filament\Resources\ContactMessages\ContactMessageResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Icons\Heroicon;

class ViewContactMessage extends ViewRecord
{
    protected static string $resource = ContactMessageResource::class;

    public function mount(int|string $record): void
    {
        parent::mount($record);

        // Mark as read automatically when opened by admin
        $this->getRecord()->markAsRead();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('reply_wa')
                ->label('Balas via WhatsApp')
                ->icon(Heroicon::OutlinedChatBubbleLeftRight)
                ->color('success')
                ->url(fn () => $this->getRecord()->wa_reply_url, shouldOpenInNewTab: true),

            EditAction::make(),
        ];
    }
}
