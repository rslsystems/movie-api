<?php

namespace Tests\Unit\Transformers;

use App\Transformers\ActorTransformer;
use Tests\TestCase;

class ActorTransformerTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function returnsCorrectArray(): void
    {
        $this->assertEquals(['name' => 'wibble'], (new ActorTransformer())->transform('wibble'));
    }
}
