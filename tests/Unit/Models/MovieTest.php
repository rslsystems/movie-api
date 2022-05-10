<?php

namespace Tests\Unit\Models;

use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class MovieTest
 *
 * @package Tests\Unit
 */
class MovieTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function actorRelationships(): void
    {
        $this->refreshTestDatabase();

        Movie::factory()->count(10)->create();
        $movies = Movie::all();

        Actor::factory()->count(10)->create();
        $actors = Actor::all();

        $movies->each(function ($movie) use ($actors) {
            $movie->actors()->attach(
                $actors->random(2)->pluck('id')->toArray()
            );
        });

        $this->assertDatabaseCount('actors', 10);
        $this->assertDatabaseCount('movies', 10);
        $this->assertDatabaseCount('actor_movie', 20);
    }
}
