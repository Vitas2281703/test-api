<?php

namespace App\Services\Api\Auth;
use App\DTO\LoginData;
use App\DTO\RegistrationData;
use App\Exceptions\DefaultException;
use App\Exceptions\EmailNotVerifyException;
use App\Exceptions\WrongLoginDataException;
use App\Models\User;
use App\Repositories\User\Abstracts\UserRepositoryInterface;
use App\Services\Api\Auth\Abstracts\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{

    public function __construct(
        public UserRepositoryInterface $repository
    )
    {
    }

    /**
     * @inheritDoc
     */
//    public function registration(RegistrationData $data): ?string {
//
//
//    }
    /**
     * @inheritDoc
     */
    public function login(LoginData $data): User|EmailNotVerifyException|WrongLoginDataException|DefaultException
    {
        $user = $this->repository->findByField('email', $data->email)->first();

        if (isset($user)){
             if (!Hash::check($data->password, $user->password)){
                 throw new WrongLoginDataException();
             }

             if (!isset($user->email_verified_at)){
                throw new EmailNotVerifyException();
             }
             return $user;
        }
        throw new DefaultException();
    }

}
