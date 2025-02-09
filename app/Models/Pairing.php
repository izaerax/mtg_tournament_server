<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pairing extends Model
{
    /** @use HasFactory<\Database\Factories\PairingFactory> */
    use HasFactory;

    public function round(): BelongsTo {
        return $this->belongsTo(Round::class);
    }

    public function results(): HasMany {
        return $this->hasMany(Result::class);
    }
}
