<?php

namespace App\Services\Api\User;
use App\DTO\UpdateUserData;
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

    /**
     * @inheritDoc
     */
    public function updateUser(?User $user, UpdateUserData $data): User{
        $path = $data->image->store('public/images');
        return $this->repository->update([
            'name' => $data->name ?? $user->name,
            'about' => $data->about,
            'avatar' => $path,
            'github' => $data->github ?? $user->github,
            'city' => $data->city ?? $user->city,
            'is_finished' => $data->is_finished ?? $user->is_finished,
            'telegram' => $data->telegram ?? $user->telegram,
            'phone' => $data->phone ?? $user->phone,
            'birthday' => $data->birthday ?? $user->birthday,
        ], $user->id);
    }
}
