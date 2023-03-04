<?php

namespace App\Entities;

use App\Traits\EntityTrait;

/**
 * Product Entity
 */
class ProductEntity
{
    use EntityTrait;

    /**
     * @var string
     */
    public string $sku;

    /**
     * @var string
     */
    public string $name;

    /**
     * @var int
     */
    public int $price;

    /**
     * @var int
     */
    public int $stock;

    /**
     * id from table categories
     * @var string
     */
    public string $category_id;
}
