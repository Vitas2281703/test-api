<?php

namespace App\DTO;

use Atwinta\DTO\DTO;
use Illuminate\Support\Facades\Hash;

class RestoreConfirmData extends DTO
{
    public function __construct(
        public string $token,
        public string $password,
    ) {
        $this->password = Hash::make($this->password);
    }
}
