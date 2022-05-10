<?php

namespace Tests\Unit\Models;

use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ActorTest
 *
 * @package Tests\Unit
 */
class ActorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function movieRelationships(): void
    {
        $this->refreshTestDatabase();

        Actor::factory()->count(10)->create();
        $actors = Actor::all();

        Movie::factory()->count(10)->create();
        $movies = Movie::all();

        $actors->each(function ($actor) use ($movies) {
            $actor->movies()->attach(
                $movies->random(2)->pluck('id')->toArray()
            );
        });

        $this->assertDatabaseCount('actors', 10);
        $this->assertDatabaseCount('movies', 10);
        $this->assertDatabaseCount('actor_movie', 20);

    }
}
