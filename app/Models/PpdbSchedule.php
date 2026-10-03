<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'date_range',
        'description',
        'is_current',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'is_current' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
