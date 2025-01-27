<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tournament extends Model
{
    use HasFactory;

    public function subscriptions(): HasMany {
        return $this->hasMany(Subscription::class);
    }

    public function rounds(): HasMany {
        return $this->hasMany(Round::class);
    }
}
