<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSamagri extends Model
{
    use HasFactory;

    protected $table = 'booking_samagri';

    protected $fillable = [
        'booking_id',
        'samagri_id',
        'quantity',
        'unit_price',
        'total_price',
        'is_kit_item',
        'kit_id',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:2',
            'unit_price' => 'decimal:2',
            'total_price' => 'decimal:2',
            'is_kit_item' => 'boolean',
        ];
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function samagriItem()
    {
        return $this->belongsTo(SamagriItem::class, 'samagri_id');
    }

    public function kit()
    {
        return $this->belongsTo(SamagriKit::class, 'kit_id');
    }
}
