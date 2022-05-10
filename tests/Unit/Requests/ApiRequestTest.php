<?php

namespace Requests;

use App\Http\Requests\ApiRequest;
use Tests\TestCase;

class ApiRequestTest extends TestCase
{
    /**
     * @test
     */
    public function authorizeTest(): void
    {
        $this->assertTrue((new ApiRequest())->authorize());
    }

    /**
     * @test
     */
    public function hasCorrectRules(): void
    {
        $expected = [
            'title' => 'nullable|string|max:191',
            'year' => 'nullable|numeric|min:1888|max:' . date('Y'),
            'actor' => 'nullable|string|max:191|exists:actors,name',
        ];

        $this->assertEquals($expected, (new ApiRequest())->rules());
    }

    /**
     * @test
     */
    public function getsAll(): void
    {
        $this->assertEquals([], (new ApiRequest())->all());
    }
}
