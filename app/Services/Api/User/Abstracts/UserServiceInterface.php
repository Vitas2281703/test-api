<?php

namespace App\Services\Api\User\Abstracts;
use App\Exceptions\DefaultException;
use App\Models\User;

interface UserServiceInterface
{
    /**
     * @return User
     * @throws DefaultException
     */
    public function getUser(): User;

}
