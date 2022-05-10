<?php

namespace App\Repositories\Contracts;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class MovieRepositoryInterface
 * @package Repositories\Contracts
 * @version 1.0.0
 */
interface MovieRepositoryInterface
{
    /**
     * Gets movies.
     * Optional parameters to filter
     * @param array $parameters
     * @return LengthAwarePaginator
     */
    public function find(array $parameters = []): LengthAwarePaginator;

    /**
     * Saves the movie to the database
     *
     * @param array<string, string> $data
     * @return Model|Movie
     */
    public function save(array $data): Model;
}
