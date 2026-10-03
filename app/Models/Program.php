<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'slug',
        'name',
        'description',
        'full_description',
        'competencies',
        'career_prospects',
        'icon',
        'image',
        'color',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active'        => 'boolean',
        'competencies'     => 'array',
        'career_prospects' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset($this->image) : null;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
