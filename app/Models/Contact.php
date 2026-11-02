<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'pic_name',
        'phone',
        'whatsapp',
        'email',
        'address',
        'office_hours',
        'maps_embed_url',
        'maps_link',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'tiktok_url',
        'default_wa_message',
        'is_primary',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('global_primary_contact');
            \Illuminate\Support\Facades\Cache::forget('global_all_contacts');
        });

        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('global_primary_contact');
            \Illuminate\Support\Facades\Cache::forget('global_all_contacts');
        });
    }

    /**
     * Get sanitized WhatsApp number with 62 prefix for links.
     */
    public function getCleanWhatsappAttribute(): string
    {
        $clean = preg_replace('/[^0-9]/', '', $this->whatsapp ?: $this->phone);
        if (str_starts_with($clean, '0')) {
            $clean = '62' . substr($clean, 1);
        }
        return $clean ?: '6285658973426';
    }

    /**
     * Generate direct wa.me link with message.
     */
    public function getWaLink(?string $message = null): string
    {
        $text = $message ?: ($this->default_wa_message ?: "Assalamu'alaikum Panitia MA Darun Najah Sambikarto, saya ingin informasi lebih lanjut.");
        return 'https://wa.me/' . $this->clean_whatsapp . '?text=' . rawurlencode($text);
    }
}
