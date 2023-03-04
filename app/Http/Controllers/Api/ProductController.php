<?php

namespace App\Http\Controllers\Api;

use App\Entities\ProductEntity;
use App\Repositories\Interfaces\ProductInterface;
use App\Transformers\ProductTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\ArraySerializer;

class ProductController extends BaseApiController
{
    public function index(Request $request, ProductInterface $repository)
    {
        return $repository->find(1);
    }

    public function create(Request $request, ProductInterface $repository)
    {
        $request->validate([
            'sku' => 'required|string|max:125|unique:products,sku',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|gt:0',
            'stock' => 'required|numeric|gt:0',
            'categoryId' => 'required|string|exists:categories,id',
        ]);


        try {
            $entity = new ProductEntity();
            $entity->name = $request->name;
            $entity->sku = $request->sku;
            $entity->price = $request->price;
            $entity->stock = $request->stock;
            $entity->category_id = $request->categoryId;

            $data = $repository->create($entity->toArray());

            $this->response->data = fractal($data->load('category'), new ProductTransformer())->toArray() ?? [];
            $this->response->success = true;

            return $this->response;
        }catch (\Exception $exception) {
            $this->response->messages = $exception->getMessage();
            return $this->response;
        }

    }
}
