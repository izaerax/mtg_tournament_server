<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\League;
use App\Http\Resources\LeagueResource;
use Illuminate\Support\Facades\DB;

class LeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leagues = League::with(['tournaments'])->latest()->paginate();
        return LeagueResource::collection($leagues);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $league = League::create([
                'name' => $request->name,
                'state' => 'new'
            ]);

            $league->tournaments()->create([
                'date' => today(),
                'rounds' => $request->rounds,
                'duration' => $request->duration,
                'games' => $request->games,
                'sub_fee' => $request->sub_fee,
            ]);

            return $league->id;
        });

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
