<?php

namespace App\Services\Contracts;

use App\Http\Resources\MovieCollection;

/**
 * Class MovieServiceInterface
 * @package Services\Contracts
 * @version 1.0.0
 */
interface MovieServiceInterface
{

    /**
     * Gets movies.
     * Optional parameters to filter
     * @param array $parameters
     * @return MovieCollection
     */
    public function find(array $parameters = []): MovieCollection;
}
