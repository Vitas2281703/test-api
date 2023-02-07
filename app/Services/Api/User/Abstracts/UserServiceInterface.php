<?php

namespace App\Services\Api\User\Abstracts;
use App\DTO\UpdateUserData;
use App\Exceptions\DefaultException;
use App\Models\User;

interface UserServiceInterface
{
    /**
     * @return User
     * @throws DefaultException
     */
    public function getUser(): User;

    /**
     * @param UpdateUserData $data
     * @return User
     */
    public function updateUser(?User $user, UpdateUserData $data): User;
}
