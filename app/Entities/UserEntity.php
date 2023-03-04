<?php

namespace App\Entities;

use App\Traits\EntityTrait;

class UserEntity
{
    use EntityTrait;

    public string $name;
    public string $email;
    public string $password;
}
