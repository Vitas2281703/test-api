<?php

namespace App\Http\Controllers\Api;

use App\DTO\LoginData;
use App\DTO\RegisterData;
use App\Exceptions\DefaultException;
use App\Exceptions\EmailNotUniqueException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\AuthTokenWithUserResource;
use App\Services\Api\Auth\Abstracts\AuthServiceInterface;

class AuthController extends Controller
{
    public function __construct(
        public AuthServiceInterface $authService,
    )
    {
    }

    /**
     * @throws DefaultException
     * @throws EmailNotUniqueException
     */
    public function register(RegisterRequest $request): AuthTokenWithUserResource
    {
        return new AuthTokenWithUserResource($this->authService->register(RegisterData::create($request->validated())));
    }
    /**
     * @param LoginRequest $request
     * @return AuthTokenWithUserResource<array>
     */
    public function login(LoginRequest $request): AuthTokenWithUserResource
    {
        return new AuthTokenWithUserResource($this->authService->login(LoginData::create($request->validated())));
    }

}
