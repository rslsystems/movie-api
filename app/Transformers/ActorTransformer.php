<?php

namespace App\Transformers;

class ActorTransformer
{
    /**
     * @param mixed $item
     * @return array
     */
    public function transform($item) : array
    {
        return [
            'name' => $item,
        ];
    }
}
