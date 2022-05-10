<?php

namespace App\Transformers;

class MovieTransformer
{
    /**
     * @param mixed $item
     * @return array
     */
    public function transform($item) : array
    {
        return [
            'title' => $item['title'],
            'year' => $item['year'],
        ];
    }
}
