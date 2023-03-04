<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Interfaces\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController extends BaseApiController
{
    public function index(Request $request, CategoryInterface $repository)
    {
        return $repository->find(1);
    }

    public function create(Request $request, CategoryInterface $repository)
    {
        $payload = $request->validate([
            'name' => 'required|string|max:255'
        ]);
        try {
            $data = $repository->create($request->all());
        }catch (\Exception $exception) {
            $this->response->messages = $exception->getMessage();
            return $this->response;
        }

    }
}
