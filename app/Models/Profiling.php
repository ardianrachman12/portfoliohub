<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profiling extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'links' => 'array',
        'jobs' => 'array',
    ];

    /**
     * Get the user that owns the Profiling
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
