<?php

namespace Tests\Unit\Traits;

use App\Traits\ModelUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ModelUuidTest
 *
 * @package Tests\Unit
 */
class ModelUuidTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function idNotIncrementing(): void
    {
        $classWithTrait = new class extends Model {
            use ModelUuid;
        };

        $this->assertFalse($classWithTrait->getIncrementing());
    }

    /**
     * @test
     *
     * @return void
     */
    public function stringKeyType(): void
    {
        $classWithTrait = new class extends Model {
            use ModelUuid;
        };

        $this->assertEquals('string', $classWithTrait->getKeyType());
    }
}
