<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    use HasFactory;

    protected $table = 'hero_slides';

    protected $fillable = [
        'title',
        'title_highlight',
        'subtitle',
        'description',
        'image',
        'button_text',
        'button_url',
        'button_secondary_text',
        'button_secondary_url',
        'badge_1',
        'badge_2',
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

    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image)) {
            return function_exists('webp_asset') ? webp_asset('assets/images/gallery-1.jpg') : asset('assets/images/gallery-1.jpg');
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
}
