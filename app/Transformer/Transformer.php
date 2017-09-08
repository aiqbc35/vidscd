<?php
namespace App\Transformer;


abstract class Transformer
{
    public function tranuformCollction($item)
    {
        return array_map([$this,'tranuform'],$item);
    }
    public abstract function tranuform($item);
}