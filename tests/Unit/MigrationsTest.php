<?php

namespace Tests\Unit;

use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class MigrationTest
 *
 * @package Tests\Unit
 */
class MigrationsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function migrations(): void
    {
        $this->refreshTestDatabase();

        Actor::factory()->create();
        Movie::factory()->create();

        $this->assertDatabaseCount('actors', 1);
        $this->assertDatabaseCount('movies', 1);
    }
}
