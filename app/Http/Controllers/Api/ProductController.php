<?php

namespace App\Http\Controllers\Api;

use App\Entities\GenericResponseEntity;
use App\Repositories\Interfaces\ProductInterface;
use App\UseCases\CreateProductUseCase;
use Illuminate\Http\Request;

class ProductController extends BaseApiController
{
    /**
     * @param Request $request
     * @param CreateProductUseCase $useCase
     * @param ProductInterface $repository
     * @return GenericResponseEntity
     */
    public function create(Request $request, CreateProductUseCase $useCase, ProductInterface $repository): GenericResponseEntity
    {
        $request->validate([
            'sku' => 'required|string|max:125|unique:products,sku',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|gt:0',
            'stock' => 'required|numeric|gt:0',
            'categoryId' => 'required|string|exists:categories,id',
        ]);

        return $useCase->exec($request, $repository);
    }
}
