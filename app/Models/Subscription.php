<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;

    public function player(): BelongsTo {
        return $this->belongsTo(Player::class, 'player_id');
    }

    public function tournament(): BelongsTo {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }
}
