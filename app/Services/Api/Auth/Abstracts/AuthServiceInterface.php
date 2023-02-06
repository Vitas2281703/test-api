<?php

namespace App\Services\Api\Auth\Abstracts;
use App\DTO\LoginData;
//use App\DTO\RegistrationData;
use App\Exceptions\DefaultException;
use App\Exceptions\EmailNotVerifyException;
use App\Exceptions\WrongLoginDataException;
use App\Models\User;

interface AuthServiceInterface
{


//    /**
//     * User registration
//     *
//     * @param RegistrationData $data
//     * @return string|null
//     */
//    public function registration(RegistrationData $data): ?string;

    /**
     * User login
     *
     * @param LoginData $data
     * @throws DefaultException|WrongLoginDataException|EmailNotVerifyException
     * @return User|EmailNotVerifyException|WrongLoginDataException|DefaultException
     */
    public function login(LoginData $data): User|EmailNotVerifyException|WrongLoginDataException|DefaultException;

}
