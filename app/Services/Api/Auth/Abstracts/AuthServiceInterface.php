<?php

namespace App\Services\Api\Auth\Abstracts;
use App\DTO\LoginData;
use App\DTO\RegisterData;
use App\DTO\RestoreConfirmData;
use App\DTO\SendData;
use App\Exceptions\DefaultException;
use App\Exceptions\EmailNotUniqueException;
use App\Exceptions\EmailNotVerifyException;
use App\Exceptions\WrongLoginDataException;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

interface AuthServiceInterface
{


    /**
     * User registration
     *
     * @param RegisterData $data
     * @return User
     *@throws EmailNotUniqueException|DefaultException
     */
    public function register(RegisterData $data): User;

    /**
     * User login
     *
     * @param LoginData $data
     * @throws DefaultException|WrongLoginDataException|EmailNotVerifyException
     * @return User
     */
    public function login(LoginData $data): User;

    /**
     * @param SendData $data
     * @return Response
     * @throws DefaultException
     */
    public function restore(SendData $data): Response;

    /**
     * @param RestoreConfirmData $data
     * @return Response
     * @throws DefaultException
     */
    public function restoreConfirm(RestoreConfirmData $data): Response;

}
