<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Database\Seeder;

/**
 * Class LocalDataSeeder
 *
 * @package Database\Seeders
 */
class LocalDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Actor::factory()->count(20)->create();
        $actors = Actor::all();

        Movie::factory()->count(10)->create();
        Movie::all()->each(function ($movie) use ($actors) {
            $movie->actors()->attach(
                $actors->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
