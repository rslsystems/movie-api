<?php

namespace App\Http\Resources;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class MovieResource
 * @package Resources
 * @version 1.0.0
 *
 * @property string $id
 * @property string $title
 * @property string $year
 * @property array<int, Actor> $actors
 * @property string $created_at
 * @property string $updated_at
 */
class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'year' => $this->year,
            'actors' => ActorResource::collection($this->actors),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
