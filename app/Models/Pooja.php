<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pooja extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'duration_minutes',
        'base_price',
        'category',
        'image',
        'is_active',
        'seo_title',
        'seo_description',
    ];

    protected function casts(): array
    {
        return [
            'base_price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pooja) {
            if (empty($pooja->slug)) {
                $pooja->slug = Str::slug($pooja->name);
            }
        });

        static::updating(function ($pooja) {
            if ($pooja->isDirty('name') && empty($pooja->slug)) {
                $pooja->slug = Str::slug($pooja->name);
            }
        });
    }

    // Relationships
    public function packages()
    {
        return $this->hasMany(PoojaPackage::class);
    }

    public function samagriItems()
    {
        return $this->belongsToMany(SamagriItem::class, 'pooja_samagri', 'pooja_id', 'samagri_id')
            ->withPivot('quantity', 'is_required')
            ->withTimestamps();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Accessors
    public function getFormattedPriceAttribute()
    {
        return '₹' . number_format($this->base_price, 2);
    }

    public function getFormattedDurationAttribute()
    {
        $hours = floor($this->duration_minutes / 60);
        $minutes = $this->duration_minutes % 60;
        
        if ($hours > 0) {
            return $hours . 'h ' . $minutes . 'm';
        }
        
        return $minutes . 'm';
    }
}
