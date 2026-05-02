<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pandit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'experience_years',
        'languages_known',
        'specialization',
        'verification_status',
        'verification_documents',
        'rating',
        'total_bookings',
        'commission_rate',
        'bio',
        'bank_account',
        'ifsc_code',
        'is_available',
    ];

    protected function casts(): array
    {
        return [
            'languages_known' => 'array',
            'specialization' => 'array',
            'verification_documents' => 'array',
            'rating' => 'decimal:2',
            'commission_rate' => 'decimal:2',
            'is_available' => 'boolean',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function availability()
    {
        return $this->hasMany(PanditAvailability::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('verification_status', 'approved');
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeByLocation($query, $latitude, $longitude, $radius = 50)
    {
        // Basic distance calculation (you might want to use a more precise formula)
        return $query->whereHas('user', function ($q) use ($latitude, $longitude, $radius) {
            $q->whereRaw(
                '(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) <= ?',
                [$latitude, $longitude, $latitude, $radius]
            );
        });
    }
}
