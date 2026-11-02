<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'full_name',
        'nisn',
        'gender',
        'birth_place',
        'birth_date',
        'school_origin',
        'parent_name',
        'phone_number',
        'address',
        'program_choice',
        'dormitory_choice',
        'status',
        'notes',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'dormitory_choice' => 'boolean',
    ];

    /**
     * Generate unique registration code: REG-DN-2026-XXXX
     */
    public static function generateRegistrationNumber(): string
    {
        $year = date('Y');
        $prefix = "REG-DN-{$year}-";
        $latest = static::where('registration_number', 'LIKE', "{$prefix}%")
            ->orderBy('id', 'desc')
            ->first();

        if ($latest) {
            $lastSeq = (int) substr($latest->registration_number, strlen($prefix));
            $nextSeq = $lastSeq + 1;
        } else {
            $nextSeq = 1;
        }

        return $prefix . str_pad((string) $nextSeq, 4, '0', STR_PAD_LEFT);
    }
}
