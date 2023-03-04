<?php

namespace App\Http\Controllers\Api;

use App\Entities\GenericResponseEntity;
use App\Repositories\Interfaces\CategoryInterface;
use App\UseCases\CreateCategoryUseCase;
use Illuminate\Http\Request;

class CategoryController extends BaseApiController
{
    /**
     * @param Request $request
     * @param CreateCategoryUseCase $useCase
     * @param CategoryInterface $repository
     * @return GenericResponseEntity
     */
    public function create(Request $request, CreateCategoryUseCase $useCase, CategoryInterface $repository): GenericResponseEntity
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        return $useCase->exec($request, $repository);
    }
}
