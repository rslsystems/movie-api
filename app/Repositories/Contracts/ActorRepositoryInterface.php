<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ActorRepositoryInterface
 * @package Repositories\Contracts
 * @version 1.0.0
 */
interface ActorRepositoryInterface
{
    /**
     * Saves the actor to the database
     *
     * @param array<string, string> $data
     * @return Model|Actor
     */
    public function save(array $data): Model;
}
