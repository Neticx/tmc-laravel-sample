<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Interfaces\CategoryInterface;
use App\Transformers\CategoryTransformer;
use Illuminate\Http\Request;

class CategoryController extends BaseApiController
{
    public function index(Request $request, CategoryInterface $repository)
    {
        return $repository->find(1);
    }

    public function create(Request $request, CategoryInterface $repository)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        try {
            $data = $repository->create($request->all());
            $this->response->data = fractal($data, new CategoryTransformer())->toArray() ?? [];
            $this->response->success = true;

            return $this->response;
        }catch (\Exception $exception) {
            $this->response->messages = $exception->getMessage();
            return $this->response;
        }

    }
}
