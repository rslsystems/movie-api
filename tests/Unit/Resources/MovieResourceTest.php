<?php

namespace Tests\Unit\Resources;

use App\Http\Resources\MovieCollection;
use App\Http\Resources\MovieResource;
use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class MovieResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function returnsCorrectArray(): void
    {
        $this->refreshTestDatabase();
        Carbon::setTestNow('2000-01-01 00:00:00');

        $actors = Actor::factory()->count(3)->create();

        $movie = Movie::factory()->create();
        $movie->actors()->sync($actors);

        $resource = (new MovieResource($movie))->toArray(new Request());

        $this->assertArrayHasKey('id', $resource);
        $this->assertArrayHasKey('title', $resource);
        $this->assertArrayHasKey('actors', $resource);
    }

    /**
     * @test
     */
    public function returnsCollection(): void
    {
        $this->refreshTestDatabase();
        Carbon::setTestNow('2000-01-01 00:00:00');

        $movies = Movie::factory()->count(3)->create();
        $collection = (new MovieCollection($movies))->toArray(new Request());

        $this->assertArrayHasKey('data', $collection);
        $this->assertArrayHasKey('links', $collection);
    }
}
