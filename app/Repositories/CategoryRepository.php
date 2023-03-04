<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryInterface;

class CategoryRepository extends BaseRepository implements CategoryInterface
{
    public function __construct(Category $category)
    {
        $this->model = $category;
    }
}
