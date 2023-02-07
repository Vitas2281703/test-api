<?php

namespace App\DTO;

use Atwinta\DTO\DTO;

class SendData extends DTO
{
    public function __construct(
        public string $email,
    ) {}
}
