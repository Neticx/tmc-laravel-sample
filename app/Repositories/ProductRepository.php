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

    /**
     * save data
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $result = $this->model->create($data);
        return $result->load('category');
    }
}
