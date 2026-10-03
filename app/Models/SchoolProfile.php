<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_content',
        'about_image',
        'about_video',
        'principal_name',
        'principal_message',
        'principal_image',
        'vision',
        'mission',
        'education_commitment',
        'history_content',
        'history_image',
    ];

    protected $casts = [
        'mission' => 'array',
    ];

    public function getAboutImageUrlAttribute(): string
    {
        return $this->about_image
            ? asset($this->about_image)
            : asset('images/profile-placeholder.jpg');
    }

    public function getHistoryImageUrlAttribute(): string
    {
        return $this->history_image
            ? asset($this->history_image)
            : asset('images/profile-placeholder.jpg');
    }

    public function getPrincipalImageUrlAttribute(): string
    {
        return $this->principal_image
            ? asset($this->principal_image)
            : asset('images/profile-placeholder.jpg');
    }
}