<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curricula';

    protected $fillable = [
        'title',
        'type',
        'category',
        'category_label',
        'grade',
        'author',
        'icon',
        'description',
        'points',
        'order',
        'is_active',
    ];

    protected $casts = [
        'points' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'pilar' => 'Pilar Utama',
            'kitab' => 'Kitab Turats Salaf',
            'vokasi' => 'Vokasi & Keterampilan',
            'program_unggulan' => 'Program Unggulan',
            default => ucfirst($this->type ?? 'Umum'),
        };
    }

    public function getGradeLabelAttribute(): string
    {
        return match ($this->grade) {
            '10' => 'Kelas X (Ula)',
            '11' => 'Kelas XI (Wustha)',
            '12' => 'Kelas XII (Ulya)',
            'all' => 'Semua Kelas',
            default => $this->grade ? 'Kelas ' . $this->grade : 'Umum',
        };
    }
}
