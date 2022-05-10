<?php

namespace Services;

use App\Models\Actor;
use App\Models\Movie;
use App\Services\Contracts\MovieServiceInterface;
use GuzzleHttp\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Mockery;
use Tests\TestCase;

/**
 * Class MovieServiceTest
 */
class MovieServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function basicFindInDatabase(): void
    {
        $this->refreshTestDatabase();
        Carbon::setTestNow('2000-01-01 00:00:00');

        $actors = Actor::factory()->count(3)->create();

        $movie = Movie::factory()->create();
        $movie->actors()->sync($actors);

        $service = app(MovieServiceInterface::class);
        $found = $service->find(['title' => $movie->title]);

        $this->assertEquals(1, $found->count());
        $this->assertEquals($movie->title, $found->first()->title);
    }

    /**
     * @test
     */
    public function actorFindInDatabase(): void
    {
        $this->refreshTestDatabase();
        Carbon::setTestNow('2000-01-01 00:00:00');

        $actors = Actor::factory()->count(3)->create();

        $movie = Movie::factory()->create();
        $movie->actors()->sync($actors);

        $service = app(MovieServiceInterface::class);
        $found = $service->find(['actor' => $actors->first()->name]);

        $this->assertContains(
            $actors->first()->name,
            array_column($found->first()->actors->toArray(), 'name')
        );
    }

    /**
     * @test
     */
    public function findInWithBackup(): void
    {
        $this->refreshTestDatabase();
        Carbon::setTestNow('2000-01-01 00:00:00');

        $apiData = [
            'Title' => 'Superman',
            'Year' => '1978',
            'Actors' => 'Christopher Reeve, Margot Kidder, Gene Hackman'
        ];
        $api = Mockery::mock(Client::class);
        $api->shouldReceive('request')
            ->with()
            ->andReturn(json_encode($apiData));

        $service = app(MovieServiceInterface::class);
        $found = $service->find(['title' => 'Superman', 'year' => 1978]);

        $this->assertEquals(1, $found->count());
        $this->assertEquals('Superman', $found->first()->title);
        $this->assertEquals(1978, $found->first()->year);
    }
}
