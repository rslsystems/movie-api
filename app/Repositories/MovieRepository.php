<?php

namespace App\Repositories;

use App\Models\Movie;
use App\Repositories\Contracts\MovieRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class MovieRepository
 * @package Repositories
 * @version 1.0.0
 * @see MovieRepositoryInterface
 *
 * @property MOdel|movie $model
 */
class MovieRepository implements MovieRepositoryInterface
{
    /**
     * @var Model|Movie
     */
    private Model $model;

    public function __construct()
    {
        $this->model = new Movie();
    }

    /**
     * @inheritDoc
     */
    public function find(array $parameters = []): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if ($actor = $parameters['actor'] ?? false) {
            unset($parameters['actor']);

            $query->whereHas('actors', function (Builder $qry) use ($actor) {
                $qry->where('name', $actor);
            });
        }

        foreach ($parameters as $column => $value) {
            $query->where($column, $value);
        }

        if ($query->count() > 0) {
            return $query->paginate(5);
        }

        throw new ModelNotFoundException();
    }

    /**
     * @param array $data
     * @return Model|Movie
     */
    public function save(array $data): Model
    {
        return $this->model->firstOrCreate($data, $data);
    }
}
