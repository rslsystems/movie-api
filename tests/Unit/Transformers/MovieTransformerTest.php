<?php

namespace Tests\Unit\Transformers;

use App\Transformers\MovieTransformer;
use Tests\TestCase;

class MovieTransformerTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function returnsCorrectArray(): void
    {
        $item = [
            'title' => 'wibble',
            'year' => 2000
        ];

        $this->assertEquals($item, (new MovieTransformer())->transform($item));
    }
}
