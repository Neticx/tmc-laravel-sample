<?php

namespace App\Repositories\Interfaces;


/**
 * base interface
 */
interface BaseEloquentInterface
{
    /**
     * find single data
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);
}
