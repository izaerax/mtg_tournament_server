<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TournamentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $totalPlayers = $this->subscriptions()->count();
        return [
            'id' => $this->id,
            'date' => $this->date,
            'rounds' => $this->rounds,
            'games' => $this->games,
            'duration' => $this->duration,
            'league' => $this->league?->name,
            'playersCount' => $totalPlayers,
            'prize' => $totalPlayers * $this->sub_fee, //TODO: define prize
        ];
    }
}
