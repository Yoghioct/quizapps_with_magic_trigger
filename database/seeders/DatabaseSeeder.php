<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('teams')->delete();
        DB::table('games')->delete();

        for ($i=1; $i <= 60; $i++) {
            Team::insert([
                'name' => 'Team '.$i,
                'total_score' => 0,
                'created_at' => Carbon::now(),
            ]);
        }

        for ($i=1; $i <= 6; $i++) {
            Game::insert([
                'name' => 'Games '.$i,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
