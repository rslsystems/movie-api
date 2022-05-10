<?php

namespace App\Providers;

use App\Repositories\ActorRepository;
use App\Repositories\MovieRepository;
use App\Services\Contracts\MovieServiceInterface;
use App\Services\MovieService;
use Illuminate\Support\ServiceProvider;

/**
 * Class ServicesServiceProvider
 * @package Providers
 * @version 1.0.0
 */
class ServicesServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(MovieServiceInterface::class, function () {
            return (new MovieService((new ActorRepository()), (new MovieRepository())));
        });
    }
}
