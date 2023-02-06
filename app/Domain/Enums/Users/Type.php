<?php

namespace App\Domain\Enums\Users;

use App\Domain\Enums\Traits\Constantable;

class Type
{
    use Constantable;

    const BACK = "back";
    const FRONT = "front";
}
