<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year',
        'intro_content',
        'requirements',
        'registration_url',
        'contact_whatsapp',
        'contact_email',
        'brochure_file',
    ];

    protected $casts = [
        'requirements' => 'array',
    ];

    public function getBrochureUrlAttribute(): ?string
    {
        return $this->brochure_file ? asset($this->brochure_file) : null;
    }

    public function getWhatsappUrlAttribute(): ?string
    {
        if (!$this->contact_whatsapp) {
            return null;
        }

        $number = preg_replace('/\D/', '', $this->contact_whatsapp);
        $number = preg_replace('/^0/', '62', $number);

        return "https://wa.me/{$number}";
    }
}
