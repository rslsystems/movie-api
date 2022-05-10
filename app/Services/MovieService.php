<?php

namespace App\Services;

use App\Http\Resources\MovieCollection;
use App\Repositories\Contracts\ActorRepositoryInterface;
use App\Repositories\Contracts\MovieRepositoryInterface;
use App\Services\Contracts\MovieServiceInterface;
use App\Transformers\ActorTransformer;
use App\Transformers\MovieTransformer;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class MovieService
 * @package Services
 * @version
 * @see MovieServiceInterface
 *
 * @property ActorRepositoryInterface $actorRepository
 * @property MovieRepositoryInterface $movieRepository
 * @property ?Client $httpClient
 */
class MovieService implements MovieServiceInterface
{
    /**
     * @var ActorRepositoryInterface
     */
    protected ActorRepositoryInterface $actorRepository;

    /**
     * @var MovieRepositoryInterface
     */
    protected MovieRepositoryInterface $movieRepository;

    /**
     * @var Client|null
     */
    protected ?Client $httpClient = null;

    /**
     * @param ActorRepositoryInterface $actorRepository
     * @param MovieRepositoryInterface $movieRepository
     */
    public function __construct(ActorRepositoryInterface $actorRepository, MovieRepositoryInterface $movieRepository)
    {
        $this->actorRepository = $actorRepository;
        $this->movieRepository = $movieRepository;

        $this->httpClient = new Client([
            'base_uri' => config('services.movie-api.url'),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function find(array $parameters = []): MovieCollection
    {
        $data = [];

        try {
            $data = $this->movieRepository->find($parameters);
        } catch (ModelNotFoundException $exception) {
            $apiData = $this->getApiBackup($parameters);

            if (!empty($apiData['movie'])) {
                $this->movieRepository->save($apiData['movie']);

                foreach ($apiData['actors'] as $actor) {
                    $this->actorRepository->save($actor);
                }
                $data = $this->movieRepository->find($parameters);
            }
        }

        return new MovieCollection($data);
    }

    /**
     * Fetches from api if not found and persists to database
     * @param array $parameters
     * @return array[]
     * @throws GuzzleException
     * @throws Exception
     */
    protected function getApiBackup(array $parameters = []): array
    {
        $data = [
            'actors' => [],
            'movie' => []
        ];

        $response = $this->httpClient->request('GET', '', $this->getQuerystring($parameters));
        $item = array_change_key_case($this->decodeJson($response->getBody()->getContents()));

        if (isset($item['response']) && $item['response'] !== 'False') {
            $data['movie'] = (new MovieTransformer())->transform($item);

            if (!empty($item['actors'])) {
                foreach (explode(', ', $item['actors']) as $actor) {
                    $data['actors'][] = (new ActorTransformer())->transform($actor);
                }
            }
        }

        return $data;
    }

    /**
     * Gets the querystring for api call
     * @param array $parameters
     * @return array|array[]
     */
    protected function getQuerystring(array $parameters = []): array
    {
        $queryString = [
            'query' => [
                'apiKey' => config('services.movie-api.token'),
            ]
        ];
        if (!empty($parameters['title'])) {
            $queryString['query']['t'] = rawurlencode($parameters['title']);
        }
        if (!empty($parameters['year'])) {
            $queryString['query']['y'] = rawurlencode($parameters['year']);
        }

        return $queryString;
    }

    /**
     * @param string $raw
     * @return array
     * @throws Exception
     */
    protected function decodeJson(string $raw): array
    {
        $decoded = json_decode($raw, true);
        $err = json_last_error();
        if ($err !== JSON_ERROR_NONE) {
            throw new Exception(json_last_error_msg() . ': ' . $raw);
        }

        return $decoded;
    }
}
