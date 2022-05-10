<?php

namespace App\Repositories;

use App\Models\Actor;
use App\Repositories\Contracts\ActorRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ActorRepository
 * @package Repositories
 * @version 1.0.0
 * @see ActorRepositoryInterface
 * @property Model $model
 */
class ActorRepository implements ActorRepositoryInterface
{
    /**
     * @var Model|Actor
     */
    private Model $model;

    /**
     * Class ActorRepository
     */
    public function __construct()
    {
        $this->model = new Actor();
    }

    /**
     * Saves the actor to the database
     *
     * @param array<string, string> $data
     * @return Model
     */
    public function save(array $data): Model
    {
        return $this->model->firstOrCreate($data, $data);
    }
}
