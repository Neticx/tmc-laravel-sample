<?php

namespace App\Entities;

use App\Traits\EntityTrait;

/**
 * Category Entity
 */
class CategoryEntity
{
    use EntityTrait;


    /**
     * @var string
     */
    public string $name;
}
