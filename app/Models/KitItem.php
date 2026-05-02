<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class KitItem extends Pivot
{
    protected $table = 'kit_items';

    protected $fillable = [
        'kit_id',
        'samagri_id',
        'quantity',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:2',
        ];
    }
}
