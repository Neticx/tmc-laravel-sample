<?php

namespace App\Traits;

trait EntityTrait
{
    public function toArray()
    {
        return (array)$this;
    }
}
