<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'histories';

    protected $fillable = [
        'title',
        'type',
        'period',
        'badge',
        'image',
        'description',
        'quote',
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

    public function scopeMilestones($query)
    {
        return $query->where('type', 'milestone');
    }

    public function scopeFigures($query)
    {
        return $query->where('type', 'tokoh');
    }

    public function scopeNarratives($query)
    {
        return $query->where('type', 'narasi');
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
            return asset($this->image);
        }

        return asset('storage/' . $this->image);
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'milestone' => 'Fase Tonggak Sejarah',
            'tokoh' => 'Tokoh & Pimpinan',
            'narasi' => 'Kilas Narasi Utama',
            default => ucfirst($this->type ?? 'Sejarah'),
        };
    }
}
