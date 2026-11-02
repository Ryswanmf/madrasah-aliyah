<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    use HasFactory;

    protected $table = 'home_settings';

    protected $fillable = [
        'ticker_text',
        'is_ticker_active',
        'welcome_badge',
        'welcome_title',
        'welcome_subtitle',
        'welcome_quote',
        'leader_name',
        'leader_role',
        'leader_image',
        'school_level',
        'accreditation_status',
        'badge_stat_1',
        'badge_stat_2',
        'badge_stat_3',

        // Identitas & Logo
        'site_name',
        'site_tagline',
        'site_logo',
        'site_favicon',
        'foundation_head',

        // Profil & Visi Misi
        'profile_title',
        'profile_highlight',
        'profile_description',
        'profile_image',
        'vision',
        'mission',

        // 4 Pilar Nilai Keunggulan
        'pillar_1_title',
        'pillar_1_desc',
        'pillar_1_icon',
        'pillar_2_title',
        'pillar_2_desc',
        'pillar_2_icon',
        'pillar_3_title',
        'pillar_3_desc',
        'pillar_3_icon',
        'pillar_4_title',
        'pillar_4_desc',
        'pillar_4_icon',

        // Counter Statistik
        'is_stats_active',
        'stat_students_count',
        'stat_students_label',
        'stat_teachers_count',
        'stat_teachers_label',
        'stat_classes_count',
        'stat_classes_label',
        'stat_alumni_count',
        'stat_alumni_label',

        // 4 Quick Access Cards
        'quick_card_1_title',
        'quick_card_1_desc',
        'quick_card_1_url',
        'quick_card_1_icon',
        'quick_card_2_title',
        'quick_card_2_desc',
        'quick_card_2_url',
        'quick_card_2_icon',
        'quick_card_3_title',
        'quick_card_3_desc',
        'quick_card_3_url',
        'quick_card_3_icon',
        'quick_card_4_title',
        'quick_card_4_desc',
        'quick_card_4_url',
        'quick_card_4_icon',

        // SEO Global
        'seo_meta_title',
        'seo_meta_description',
        'seo_meta_keywords',
        'seo_og_image',
    ];

    protected $casts = [
        'is_ticker_active' => 'boolean',
        'is_stats_active' => 'boolean',
    ];

    public function getLeaderImageUrlAttribute(): ?string
    {
        return $this->resolveImageUrl($this->leader_image);
    }

    public function getSiteLogoUrlAttribute(): string
    {
        return $this->resolveImageUrl($this->site_logo) ?: asset('assets/images/logo.png');
    }

    public function getSiteFaviconUrlAttribute(): ?string
    {
        return $this->resolveImageUrl($this->site_favicon) ?: asset('assets/images/logo.png');
    }

    public function getProfileImageUrlAttribute(): string
    {
        return $this->resolveImageUrl($this->profile_image) ?: asset('assets/images/gedung-2.jpg');
    }

    protected static function booted(): void
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('global_site_setting');
        });

        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('global_site_setting');
        });
    }

    public function getSeoOgImageUrlAttribute(): string
    {
        return $this->resolveImageUrl($this->seo_og_image) ?: (function_exists('webp_asset') ? webp_asset('assets/images/gedung-1.jpg') : asset('assets/images/gedung-1.jpg'));
    }

    private function resolveImageUrl(?string $image): ?string
    {
        if (empty($image)) {
            return null;
        }

        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }

        if (str_starts_with($image, 'assets/')) {
            return function_exists('webp_asset') ? webp_asset($image) : asset($image);
        }

        $path = 'storage/' . $image;
        return function_exists('to_webp_url') ? to_webp_url(asset($path)) : asset($path);
    }
}
