<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    use HasFactory;

    protected $table = 'extracurriculars';

    protected $fillable = [
        'name',
        'category',
        'badge',
        'icon',
        'color',
        'schedule',
        'coach',
        'description',
        'image',
        'order',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image)) {
            return null;
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
            'seni' => 'Seni Islami & Bahasa',
            'olahraga' => 'Olahraga & Bela Diri',
            'organisasi' => 'Kepanduan & Organisasi',
            'vokasi' => 'TIK & Keterampilan',
            default => ucfirst($this->category ?? 'Umum'),
        };
    }

    public function getDisplayIconAttribute(): string
    {
        if (!empty($this->icon)) {
            return $this->icon;
        }

        return match ($this->category) {
            'seni' => 'fa-solid fa-drum',
            'olahraga' => 'fa-solid fa-shield-halved',
            'organisasi' => 'fa-solid fa-campground',
            'vokasi' => 'fa-solid fa-laptop-code',
            default => 'fa-solid fa-star',
        };
    }

    public function getColorThemeAttribute(): array
    {
        return match ($this->color) {
            'red' => [
                'border' => 'border-t-red-600',
                'icon_bg' => 'bg-red-100 text-red-800 border-red-200',
                'badge' => 'bg-red-50 text-red-800 border-red-200',
            ],
            'purple' => [
                'border' => 'border-t-purple-600',
                'icon_bg' => 'bg-purple-100 text-purple-800 border-purple-200',
                'badge' => 'bg-purple-50 text-purple-800 border-purple-200',
            ],
            'blue' => [
                'border' => 'border-t-blue-600',
                'icon_bg' => 'bg-blue-100 text-blue-800 border-blue-200',
                'badge' => 'bg-blue-50 text-blue-800 border-blue-200',
            ],
            'amber' => [
                'border' => 'border-t-amber-500',
                'icon_bg' => 'bg-amber-100 text-amber-800 border-amber-200',
                'badge' => 'bg-amber-50 text-amber-800 border-amber-200',
            ],
            default => [
                'border' => 'border-t-emerald-600',
                'icon_bg' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                'badge' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
            ],
        };
    }
}
