<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $table = 'achievements';

    protected $fillable = [
        'title',
        'student_name',
        'category',
        'level',
        'year',
        'organizer',
        'image',
        'description',
        'order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
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

    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return function_exists('webp_asset') ? webp_asset('assets/images/gallery-2.jpg') : asset('assets/images/gallery-2.jpg');
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

    public function getLevelLabelAttribute(): string
    {
        return match($this->level) {
            'kecamatan' => 'Tingkat Kecamatan',
            'kabupaten' => 'Tingkat Kabupaten',
            'provinsi' => 'Tingkat Provinsi',
            'nasional' => 'Tingkat Nasional',
            'internasional' => 'Tingkat Internasional',
            default => ucfirst($this->level),
        };
    }
}
