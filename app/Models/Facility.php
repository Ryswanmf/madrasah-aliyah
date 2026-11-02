<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $table = 'facilities';

    protected $fillable = [
        'name',
        'category',
        'image',
        'description',
        'details',
        'icon',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image)) {
            return function_exists('webp_asset') ? webp_asset('assets/images/gedung-1.jpg') : asset('assets/images/gedung-1.jpg');
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        if (str_starts_with($this->image, 'assets/')) {
            return function_exists('webp_asset') ? webp_asset($this->image) : asset($this->image);
        }

        $url = asset('storage/' . $this->image);
        return function_exists('to_webp_url') ? to_webp_url($url) : $url;
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'akademik' => 'Gedung & Kelas',
            'asrama' => 'Asrama Santri',
            'ibadah' => 'Masjid & Religi',
            'olahraga' => 'Sarana Olahraga',
            'penunjang' => 'Laboratorium & TIK',
            default => ucfirst($this->category ?? 'Umum'),
        };
    }

    public function getCategoryIconAttribute(): string
    {
        if (!empty($this->icon)) {
            return $this->icon;
        }

        return match ($this->category) {
            'akademik' => 'fa-solid fa-school',
            'asrama' => 'fa-solid fa-hotel',
            'ibadah' => 'fa-solid fa-mosque',
            'olahraga' => 'fa-solid fa-futbol',
            'penunjang' => 'fa-solid fa-laptop-code',
            default => 'fa-solid fa-building',
        };
    }
}
