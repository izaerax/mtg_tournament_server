<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\League;
use App\Models\Tournament;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password'=> Hash::make('admin')
        ]);

        User::factory()->count(40)->create();

        $league = League::factory()->create(['name' => 'Cittadino 1']);
        Tournament::factory()
            ->count(5)
            ->withLeague($league)
            ->withRandomSubscriptions()
            ->create();

        $league = League::factory()->create(['name' => 'Cittadino 2']);
        Tournament::factory()->count(5)->withLeague($league)->create();
    }
}
