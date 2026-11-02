<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonials';

    protected $fillable = [
        'name',
        'role',
        'category',
        'avatar',
        'content',
        'rating',
        'graduation_year',
        'order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'rating' => 'integer',
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

    public function getAvatarUrlAttribute(): string
    {
        if (empty($this->avatar)) {
            return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=064e3b&color=fbbf24&bold=true&size=128';
        }

        if (str_starts_with($this->avatar, 'http://') || str_starts_with($this->avatar, 'https://')) {
            return $this->avatar;
        }

        if (str_starts_with($this->avatar, 'assets/')) {
            return asset($this->avatar);
        }

        return asset('storage/' . $this->avatar);
    }

    public function getCategoryLabelAttribute(): string
    {
        return match($this->category) {
            'alumni' => 'Alumni Madrasah',
            'wali_santri' => 'Wali Santri',
            'santri' => 'Santri Aktif',
            'tokoh' => 'Tokoh Masyarakat',
            default => ucfirst(str_replace('_', ' ', $this->category)),
        };
    }
}
