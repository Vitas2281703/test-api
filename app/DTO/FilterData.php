<?php

namespace App\DTO;

use Atwinta\DTO\DTO;

class FilterData extends DTO
{
    public function __construct(
        public ?string $query,
        public ?int $department_id,
        public ?int $position_id,
    ) {}
}
