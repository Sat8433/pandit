<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanditAvailability extends Model
{
    use HasFactory;

    protected $table = 'pandit_availability';

    protected $fillable = [
        'pandit_id',
        'date',
        'start_time',
        'end_time',
        'is_available',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'is_available' => 'boolean',
        ];
    }

    public function pandit()
    {
        return $this->belongsTo(Pandit::class);
    }
}
