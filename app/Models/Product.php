<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'title',
        'slug',
        'description',
        'image',
        'link',
        'team',
        'year',
        'order',
        'is_active',
        'sale_status',
        'price',            
        'contact_whatsapp', 
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset($this->image) : null;
    }

    // Jurusan pembuat produk ini
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public const STATUS_LABELS = [
        'tersedia'   => 'Tersedia',
        'pesanan'    => 'Terima Pesanan',
        'portofolio' => 'Portofolio',
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->sale_status] ?? 'Portofolio';
    }

    public function getPriceLabelAttribute(): ?string
    {
        if ($this->sale_status === 'portofolio') {
            return null;
        }
        if ($this->price) {
            return 'Rp ' . number_format($this->price, 0, ',', '.');
        }
        return 'Hubungi untuk harga';
    }

    public function getWhatsappUrlAttribute(): ?string
    {
        if ($this->sale_status === 'portofolio') {
            return null;
        }

        $number = preg_replace('/\D/', '', $this->contact_whatsapp ?: config('sisk4.whatsapp'));
        if (! $number) {
            return null;
        }
        if (str_starts_with($number, '0')) {
            $number = '62' . substr($number, 1);
        }

        $text = "Halo, saya tertarik dengan produk *{$this->title}* di website SISK4. Boleh tahu info lebih lanjut?";

        return 'https://wa.me/' . $number . '?text=' . rawurlencode($text);
    }
}