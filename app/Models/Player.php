<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'dci_number'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'player_id');
    }

    public function subscriptions(): HasMany {
        return $this->hasMany(Subscription::class, 'player_id');
    }

    public function tournaments(): HasManyThrough {
        return $this->hasManyThrough(Tournament::class, Subscription::class);
    }
}
