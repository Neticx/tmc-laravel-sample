<?php

namespace App\Entities;

class UserEntity
{
    public string $name;
    public string $email;
    public string $password;

    public function toArray()
    {
        return (array)$this;
    }
}
