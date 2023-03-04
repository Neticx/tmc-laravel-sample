<?php

namespace App\Repositories\Interfaces;

interface ProductInterface extends BaseEloquentInterface
{
    public function findWithCategory($id);
}
