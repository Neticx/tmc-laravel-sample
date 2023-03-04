<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductInterface;

/**
 * Product Repository
 */
class ProductRepository extends BaseRepository implements ProductInterface
{
    /**
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function findWithCategory($id)
    {
        return $this->model->with('category')->find($id);
    }
}
