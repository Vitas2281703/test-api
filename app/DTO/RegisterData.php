<?php

namespace App\DTO;

use Atwinta\DTO\DTO;
use Illuminate\Support\Facades\Hash;

class RegisterData extends DTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $type,
        public ?string $github,
        public ?string $City,
        public string $phone,
        public ?string $birthday,
        public string $password,
    ) {
        $this->password = Hash::make($this->password);
    }
}
