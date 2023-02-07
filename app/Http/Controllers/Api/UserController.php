<?php

namespace App\Http\Controllers\Api;

use App\DTO\UpdateUserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\Api\User\Abstracts\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(
        public UserServiceInterface $userService,
    )
    {
    }

    /**
     * @return UserResource
     * @throws \App\Exceptions\DefaultException
     */
    public function getUser(): UserResource
    {
        return new UserResource($this->userService->getUser());
    }

    public function updateUser(UpdateUserRequest $request): UserResource
    {
        return new UserResource($this->userService->updateUser(Auth::user(), UpdateUserData::create($request->validated())));
    }
}
