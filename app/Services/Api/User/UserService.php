<?php

namespace App\Services\Api\User;
use App\Exceptions\DefaultException;
use App\Models\User;
use App\Repositories\User\Abstracts\UserRepositoryInterface;
use App\Services\Api\User\Abstracts\UserServiceInterface;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{

    public function __construct(
        public UserRepositoryInterface $repository
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function getUser(): User
    {
        if (Auth::user()){
            return $this->repository->findByField('id', Auth::user()->id)->first();
        }
        throw new DefaultException();
    }

}
