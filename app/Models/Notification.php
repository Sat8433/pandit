<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pandit_id',
        'title',
        'message',
        'type',
        'is_read',
        'sent_via',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
            'sent_via' => 'array',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pandit()
    {
        return $this->belongsTo(Pandit::class);
    }
}
