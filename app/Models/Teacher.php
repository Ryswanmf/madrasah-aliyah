<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';

    protected $fillable = [
        'name',
        'nip_or_niy',
        'role',
        'category',
        'photo',
        'education',
        'bio',
        'phone',
        'order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'order' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getPhotoUrlAttribute(): string
    {
        if (empty($this->photo)) {
            return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=064e3b&color=fbbf24&bold=true&size=256';
        }

        if (str_starts_with($this->photo, 'http://') || str_starts_with($this->photo, 'https://')) {
            return $this->photo;
        }

        if (str_starts_with($this->photo, 'assets/')) {
            return function_exists('webp_asset') ? webp_asset($this->photo) : asset($this->photo);
        }

        $url = asset('storage/' . $this->photo);
        return function_exists('to_webp_url') ? to_webp_url($url) : $url;
    }

    public function getCategoryLabelAttribute(): string
    {
        return match($this->category) {
            'pimpinan' => 'Pimpinan & Guru Pembina',
            'asatidz_kitab' => 'Dewan Guru Keagamaan & Kitab',
            'guru_mapel' => 'Guru Mata Pelajaran',
            'staf' => 'Tenaga Kependidikan & TU',
            default => ucfirst(str_replace('_', ' ', $this->category)),
        };
    }
}
