<?php

namespace Tests\Feature;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Class ExampleTest
 *
 * @package Tests\Feature
 */
class MovieApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->json('get', route('movies.index'));

        $response->assertOk();
    }
}
