<?php

namespace App\Providers;

use App\Repositories\ActorRepository;
use App\Repositories\Contracts\ActorRepositoryInterface;
use App\Repositories\Contracts\MovieRepositoryInterface;
use App\Repositories\MovieRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package Providers
 * @version 1.0.0
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(ActorRepositoryInterface::class, ActorRepository::class);
        $this->app->bind(MovieRepositoryInterface::class, MovieRepository::class);
    }
}
