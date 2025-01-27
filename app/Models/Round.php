<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Round extends Model
{
    use HasFactory;

    public function tournament(): BelongsTo {
        return $this->belongsTo(Tournament::class);
    }

    public function results(): HasMany {
        return $this->hasMany(Result::class);
    }
}
