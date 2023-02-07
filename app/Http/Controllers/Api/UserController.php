<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\Api\User\Abstracts\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        public UserServiceInterface $userService,
    )
    {
    }

    public function getUser(): UserResource
    {
        return new UserResource($this->userService->getUser());
    }
}
