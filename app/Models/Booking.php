<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pandit_id',
        'pooja_id',
        'pooja_package_id',
        'booking_date',
        'start_time',
        'end_time',
        'status',
        'pooja_price',
        'samagri_price',
        'pandit_charges',
        'platform_fee',
        'total_amount',
        'address',
        'landmark',
        'city',
        'state',
        'pincode',
        'latitude',
        'longitude',
        'special_instructions',
        'assigned_at',
        'started_at',
        'completed_at',
        'cancelled_at',
        'cancellation_reason',
    ];

    protected function casts(): array
    {
        return [
            'booking_date' => 'date',
            'start_time' => 'datetime',
            'end_time' => 'datetime',
            'pooja_price' => 'decimal:2',
            'samagri_price' => 'decimal:2',
            'pandit_charges' => 'decimal:2',
            'platform_fee' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'assigned_at' => 'datetime',
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pandit()
    {
        return $this->belongsTo(Pandit::class);
    }

    public function pooja()
    {
        return $this->belongsTo(Pooja::class);
    }

    public function poojaPackage()
    {
        return $this->belongsTo(PoojaPackage::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function samagriItems()
    {
        return $this->belongsToMany(SamagriItem::class, 'booking_samagri')
            ->withPivot('quantity', 'unit_price', 'total_price', 'is_kit_item', 'kit_id')
            ->withTimestamps();
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeByDate($query, $date)
    {
        return $query->whereDate('booking_date', $date);
    }

    public function scopeByPandit($query, $panditId)
    {
        return $query->where('pandit_id', $panditId);
    }

    // Methods
    public function canBeCancelled()
    {
        return in_array($this->status, ['pending', 'confirmed']) && 
               !$this->started_at;
    }

    public function canBeReviewed()
    {
        return $this->status === 'completed' && 
               !$this->review;
    }

    public function getFormattedTotalAttribute()
    {
        return '₹' . number_format($this->total_amount, 2);
    }

    public function getFullAddressAttribute()
    {
        $address = $this->address;
        
        if ($this->landmark) {
            $address .= ', ' . $this->landmark;
        }
        
        $address .= ', ' . $this->city . ', ' . $this->state . ' - ' . $this->pincode;
        
        return $address;
    }
}
