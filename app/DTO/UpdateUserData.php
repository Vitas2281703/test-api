<?php

namespace App\DTO;

use Atwinta\DTO\DTO;
use Illuminate\Http\UploadedFile;

class UpdateUserData extends DTO
{
    public function __construct(
        public ?string $name,
        public string $about,
        public UploadedFile $image,
        public ?string $github,
        public ?string $city,
        public ?bool $is_finished,
        public ?string $telegram,
        public ?string $phone,
        public ?string $birthday,
    ) {}
}
