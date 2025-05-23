<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class League extends Model
{
    /** @use HasFactory<\Database\Factories\LeagueFactory> */
    use HasFactory;

    public static $states = ['new', 'ongoing', 'finished'];

    protected $guarded = ['id'];

    public function tournaments(): HasMany {
        return $this->hasMany(Tournament::class);
    }
}
