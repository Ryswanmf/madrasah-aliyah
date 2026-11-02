<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'slug',
        'category',
        'image',
        'excerpt',
        'content',
        'author',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_published',
        'is_featured',
        'views_count',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'views_count' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getImageUrlAttribute(): string
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

    public function getFormattedDateAttribute(): string
    {
        $date = $this->published_at ?? $this->created_at;
        return $date ? $date->translatedFormat('d F Y') : '-';
    }

    public function getReadingTimeAttribute(): string
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $minutes = max(1, (int) ceil($wordCount / 180));
        return $minutes . ' menit baca';
    }

    public function getSeoTitleAttribute(): string
    {
        return $this->meta_title ?: $this->title . ' • MA Darun Najah Sambikarto';
    }

    public function getSeoDescriptionAttribute(): string
    {
        if (!empty($this->meta_description)) {
            return $this->meta_description;
        }
        if (!empty($this->excerpt)) {
            return Str::limit(strip_tags($this->excerpt), 160);
        }
        return Str::limit(strip_tags($this->content), 160);
    }

    public function getCategoryColorAttribute(): array
    {
        $cat = strtolower($this->category ?? '');
        if (str_contains($cat, 'ppdb')) {
            return ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-800', 'border' => 'border-emerald-200'];
        }
        if (str_contains($cat, 'prestasi')) {
            return ['bg' => 'bg-amber-100', 'text' => 'text-amber-800', 'border' => 'border-amber-200'];
        }
        if (str_contains($cat, 'pesantren') || str_contains($cat, 'santri') || str_contains($cat, 'kitab')) {
            return ['bg' => 'bg-teal-100', 'text' => 'text-teal-800', 'border' => 'border-teal-200'];
        }
        if (str_contains($cat, 'vokasi') || str_contains($cat, 'tik') || str_contains($cat, 'komputer')) {
            return ['bg' => 'bg-sky-100', 'text' => 'text-sky-800', 'border' => 'border-sky-200'];
        }
        return ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-800', 'border' => 'border-emerald-200'];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (empty($news->slug)) {
                $base = Str::slug($news->title);
                $slug = $base;
                $count = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = "{$base}-" . ($count++);
                }
                $news->slug = $slug;
            }
            if (empty($news->published_at)) {
                $news->published_at = now();
            }
        });
    }
}
