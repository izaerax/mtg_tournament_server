<?php

namespace Database\Factories;
use App\Models\League;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tournament>
 */
class TournamentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => now(),
            'rounds' => 4,
            'games' => 3,
            'duration' => 45
        ];
    }

    public function withLeague(League $league) {
        return $this->state(fn () => [
            'league_id' => $league->id,
        ]);
    }
}
