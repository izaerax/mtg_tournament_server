<?php

namespace Database\Factories;
use App\Models\League;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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

    /**
     * create subscriptions for the tournament based on existing users
     */
    public function withRandomSubscriptions() {
        return $this->afterCreating(fn ($tournament) =>
            array_map(fn ($user) =>
                $tournament->subscriptions()->create([
                    'user_id' => $user
                ]), User::inRandomOrder()->limit(10)->pluck('id')->toArray()
            )
        );
    }
}
