<?php

namespace Tests\Unit\Resources;

use App\Http\Resources\ActorResource;
use App\Models\Actor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class ActorResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function returnsCorrectArray(): void
    {
        Carbon::setTestNow('2000-01-01 00:00:00');

        $attributes = [
            'id' => '00000000-0000-0000-000000000000',
            'name' => 'wibble',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        $actor = Actor::factory()->make($attributes);
        $resource = (new ActorResource($actor))->toArray(new Request());

        $this->assertEquals([
            'id' => '00000000-0000-0000-000000000000',
            'name' => 'wibble',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ], $resource);
    }

    /**
     * @test
     */
    public function returnsCollection(): void
    {
        $this->refreshTestDatabase();
        Carbon::setTestNow('2000-01-01 00:00:00');

        $actors = Actor::factory()->count(3)->create();
        $collection = ActorResource::collection($actors);

        $this->assertInstanceOf(AnonymousResourceCollection::class, $collection);
    }
}
