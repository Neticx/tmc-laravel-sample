<?php

namespace App\Traits;

trait EntityTrait
{
    /**
     * cast to array
     * @return array
     */
    public function toArray()
    {
        return (array)$this;
    }
}
