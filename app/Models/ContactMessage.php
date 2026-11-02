<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $table = 'contact_messages';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'subject',
        'message',
        'is_read',
        'read_at',
        'is_replied',
        'replied_at',
        'admin_notes',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'is_replied' => 'boolean',
        'replied_at' => 'datetime',
    ];

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    public function scopeReplied($query)
    {
        return $query->where('is_replied', true);
    }

    public function getCleanPhoneAttribute(): string
    {
        $clean = preg_replace('/[^0-9]/', '', (string) $this->phone);
        if (str_starts_with($clean, '0')) {
            $clean = '62' . substr($clean, 1);
        }
        return $clean;
    }

    public function getWaReplyUrlAttribute(): string
    {
        $clean = $this->clean_phone;
        $text = "Assalamu'alaikum Wr. Wb. Bapak/Ibu {$this->name},\n\nTerima kasih telah menghubungi Sekretariat MA Darun Najah Sambikarto perihal *{$this->subject}*.\n\nMenanggapi pertanyaan yang Anda sampaikan melalui website:\n\n";

        return "https://wa.me/{$clean}?text=" . rawurlencode($text);
    }

    public function markAsRead(): void
    {
        if (! $this->is_read) {
            $this->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
        }
    }

    public function markAsReplied(?string $notes = null): void
    {
        $payload = [
            'is_read' => true,
            'read_at' => $this->read_at ?? now(),
            'is_replied' => true,
            'replied_at' => now(),
        ];

        if ($notes !== null) {
            $payload['admin_notes'] = $notes;
        }

        $this->update($payload);
    }
}
