<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseEloquentInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseEloquentInterface
{
    /**
     * @var Model
     */
    protected $model;

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}
