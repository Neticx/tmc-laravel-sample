<?php

namespace App\UseCases;

use App\Entities\GenericResponseEntity;
use App\Entities\ProductEntity;
use App\Repositories\Interfaces\ProductInterface;
use App\Transformers\ProductTransformer;

class CreateProductUseCase
{
    /**
     * @var GenericResponseEntity
     */
    protected $response;

    /**
     * @param $payload
     * @param ProductInterface $repository
     * @return GenericResponseEntity
     */
    public function exec($payload, ProductInterface $repository): GenericResponseEntity
    {
        $this->response = new GenericResponseEntity();

        try {
            $entity = new ProductEntity();
            $entity->name = $payload->name;
            $entity->sku = $payload->sku;
            $entity->price = $payload->price;
            $entity->stock = $payload->stock;
            $entity->category_id = $payload->categoryId;

            $result = $repository->create($entity->toArray());
            $this->response->data = fractal($result, new ProductTransformer())->toArray() ?? [];
            $this->response->success = true;

            return $this->response;
        }catch (\Exception $exception) {
            $this->response->messages = $exception->getMessage();
            return $this->response;
        }
    }
}
