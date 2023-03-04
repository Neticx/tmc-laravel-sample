<?php

namespace App\UseCases;

use App\Entities\CategoryEntity;
use App\Entities\GenericResponseEntity;
use App\Repositories\Interfaces\CategoryInterface;
use App\Transformers\CategoryTransformer;

class CreateCategoryUseCase
{
    /**
     * @var GenericResponseEntity
     */
    protected GenericResponseEntity $response;

    /**
     * @param $request
     * @param CategoryInterface $repository
     * @return GenericResponseEntity
     */
    public function exec($request, CategoryInterface $repository): GenericResponseEntity
    {
        $this->response = new GenericResponseEntity();

        try {
            $entity = new CategoryEntity();
            $entity->name = $request->name;
            $data = $repository->create($entity->toArray());
            $this->response->data = fractal($data, new CategoryTransformer())->toArray() ?? [];
            $this->response->success = true;

            return $this->response;
        }catch (\Exception $exception) {
            $this->response->messages = $exception->getMessage();
            return $this->response;
        }
    }
}
