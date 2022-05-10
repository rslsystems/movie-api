<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequest;
use App\Http\Resources\MovieCollection;
use App\Services\Contracts\MovieServiceInterface;

/**
 * Class MovieController
 * @package Controllers\Api
 * @version 1.0.0
 *
 * @property MovieServiceInterface $service
 */
class MovieController extends Controller
{
    /**
     * @var MovieServiceInterface
     */
    private MovieServiceInterface $service;

    /**
     * @param MovieServiceInterface $service
     */
    public function __construct(MovieServiceInterface $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Display a listing of movies.
     *
     * @param ApiRequest $request
     * @return MovieCollection
     */
    public function index(ApiRequest $request): MovieCollection
    {
        $validated = $request->validated();
        return $this->service->find($validated);
    }
}
