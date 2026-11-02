<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbSetting extends Model
{
    use HasFactory;

    protected $table = 'ppdb_settings';

    protected $fillable = [
        'is_open',
        'academic_year',
        'wave_name',
        'wave_period',
        'quota_info',
        'closed_message',
        'step_1_title',
        'step_1_desc',
        'step_2_title',
        'step_2_desc',
        'step_3_title',
        'step_3_desc',
        'step_4_title',
        'step_4_desc',
        'requirements',
        'contact_phone',
        'contact_name',
        'contact_wa_template',
    ];

    protected $casts = [
        'is_open' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('global_ppdb_setting');
        });

        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('global_ppdb_setting');
        });
    }

    /**
     * Get requirements as an array of items split by newline.
     */
    public function getRequirementsListAttribute(): array
    {
        if (empty($this->requirements)) {
            return [
                'Fotokopi Ijazah / SKL SMP/MTs (legalisir 2 lembar)',
                'Fotokopi Kartu Keluarga (KK) & KTP Orang Tua',
                'Fotokopi Akta Kelahiran calon santri',
                'Pas foto ukuran 3x4 (4 lembar, latar biru/merah)',
                'Fotokopi KIP / PKH / Piagam Prestasi (jika memiliki)',
            ];
        }

        $lines = preg_split('/\r\n|\r|\n/', $this->requirements);
        return array_values(array_filter(array_map('trim', $lines)));
    }

    /**
     * Get sanitized WhatsApp link.
     */
    public function getWaLinkAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->contact_phone ?: '085658973426');
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }
        $msg = urlencode($this->contact_wa_template ?: 'Assalamu’alaikum Panitia PPDB MA Darun Najah Sambikarto, saya ingin konfirmasi pendaftaran.');
        return "https://wa.me/{$phone}?text={$msg}";
    }
}
