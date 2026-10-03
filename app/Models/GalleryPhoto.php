<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'caption',
        'description',
        'taken_at',
        'category',
        'show_on_home',
        'order',
        'is_active',
        'likes'
    ];

    protected $casts = [
        'is_active'    => 'boolean',
        'show_on_home' => 'boolean',
        'taken_at'     => 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function scopeOnHome($query)
    {
        return $query->where('show_on_home', true);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset($this->image) : null;
    }
}
