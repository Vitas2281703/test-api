<?php

namespace App\Http\Controllers\Api;

use App\DTO\LoginData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
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
     * @param LoginRequest $request
     * @return AuthTokenWithUserResource<array>
     */
    public function login(LoginRequest $request){
        return new AuthTokenWithUserResource($this->authService->login(LoginData::create($request->validated())));
    }

}
