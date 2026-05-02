<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SamagriItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'unit',
        'price_per_unit',
        'stock_quantity',
        'is_active',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'price_per_unit' => 'decimal:2',
            'stock_quantity' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function poojas()
    {
        return $this->belongsToMany(Pooja::class, 'pooja_samagri')
            ->withPivot('quantity', 'is_required')
            ->withTimestamps();
    }

    public function kits()
    {
        return $this->belongsToMany(SamagriKit::class, 'kit_items')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_samagri')
            ->withPivot('quantity', 'unit_price', 'total_price', 'is_kit_item', 'kit_id')
            ->withTimestamps();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock_quantity', '>', 0);
    }

    // Accessors
    public function getFormattedPriceAttribute()
    {
        return '₹' . number_format($this->price_per_unit, 2);
    }
}
