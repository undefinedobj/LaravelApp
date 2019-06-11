<?php


namespace App\Transformer;

/**
 * Class Transformer
 * @package App\Transformer
 */
abstract class Transformer
{
    /**
     * @param $items
     * @return array
     */
    public function transformCollection($items)
    {
        return array_map([$this, 'transformer'], $items);
    }

    /**
     * @param $items
     * @return mixed
     */
    public abstract function transformer($items);
}
