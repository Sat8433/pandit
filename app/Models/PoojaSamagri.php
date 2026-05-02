<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PoojaSamagri extends Pivot
{
    protected $table = 'pooja_samagri';

    protected $fillable = [
        'pooja_id',
        'samagri_id',
        'quantity',
        'is_required',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:2',
            'is_required' => 'boolean',
        ];
    }
}
