<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class CategoryController extends BaseApiController
{
    public function index(Request $request)
    {
        return $this->response;
    }
}
