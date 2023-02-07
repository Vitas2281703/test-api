<?php

namespace App\Http\Controllers\Api;

use App\DTO\LoginData;
use App\DTO\RegisterData;
use App\DTO\RestoreConfirmData;
use App\DTO\SendData;
use App\Exceptions\DefaultException;
use App\Exceptions\EmailNotUniqueException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\RestoreConfirmRequest;
use App\Http\Requests\Api\SendRequest;
use App\Http\Resources\AuthTokenWithUserResource;
use App\Services\Api\Auth\Abstracts\WorkerServiceInterface;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(
        public WorkerServiceInterface $authService,
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

    /**
     * @param SendRequest $request
     * @return Response
     * @throws DefaultException
     */
    public function restore(SendRequest $request): Response
    {
        return $this->authService->restore(SendData::create($request->validated()));
    }

    /**
     * @param RestoreConfirmRequest $request
     * @return Response
     * @throws DefaultException
     */
    public function restoreConfirm(RestoreConfirmRequest $request): Response
    {
        return $this->authService->restoreConfirm(RestoreConfirmData::create($request->validated()));
    }

}
