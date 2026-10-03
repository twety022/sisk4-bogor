<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'phone',
        'whatsapp',
        'email',
        'office_hours',
        'map_embed_url',
        'instagram_url',
        'facebook_url',
        'youtube_url',
        'tiktok_url',
    ];
    
    public function getWhatsappUrlAttribute(): ?string
    {
        if (!$this->whatsapp) {
            return null;
        }

        $number = preg_replace('/\D/', '', $this->whatsapp);
        $number = preg_replace('/^0/', '62', $number);

        return "https://wa.me/{$number}";
    }
}
