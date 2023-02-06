<?php

namespace App\Services\Api\Auth;
use App\DTO\LoginData;
use App\DTO\RegisterData;
use App\Exceptions\DefaultException;
use App\Exceptions\EmailNotUniqueException;
use App\Exceptions\EmailNotVerifyException;
use App\Exceptions\WrongLoginDataException;
use App\Models\User;
use App\Repositories\User\Abstracts\UserRepositoryInterface;
use App\Services\Api\Auth\Abstracts\AuthServiceInterface;
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
    public function register(RegisterData $data): User
    {
        $user = $this->repository->findByField('email', $data->email)->first();

        if (!isset($user)){
            return $this->repository->create($data->toArray());
        }else{
            throw new EmailNotUniqueException();
        }

    }
    /**
     * @inheritDoc
     */
    public function login(LoginData $data): User
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
