<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlayerResource;
use App\Models\Player;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $players = Player::query();
        return PlayerResource::collection($players->paginate());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $player = Player::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'dci_number' => $request->dci_number,
        ]);
        $request->user()->update([
            'player_id' => $player->id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
        ]);

        if ($request->user()->player) {
            abort(400, 'Questo utente ha giá un giocatore collegato');
        }

        $request->user()->player_id = Player::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'dci_number' => $request->dci_number,
        ])->id;
        $request->user()->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
        ]);
        $player->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'dci_number' => $request->dci_number
        ]);

        $player->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        //
    }
}
