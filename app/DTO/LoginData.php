<?php

namespace App\DTO;

use Atwinta\DTO\DTO;

class LoginData extends DTO
{
    public function __construct(
        public string $email,
        public string $password
    ) {}
}
