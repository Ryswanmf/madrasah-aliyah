<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'category_label',
        'image',
        'description',
        'order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get accessible image URL (whether assets/images or storage/...)
     */
    public function getImageUrlAttribute(): string
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
