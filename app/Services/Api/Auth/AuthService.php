<?php

namespace App\Services\Api\Auth;
use App\DTO\LoginData;
use App\DTO\RegisterData;
use App\DTO\RestoreConfirmData;
use App\DTO\SendData;
use App\Exceptions\DefaultException;
use App\Exceptions\EmailNotUniqueException;
use App\Exceptions\EmailNotVerifyException;
use App\Exceptions\WrongLoginDataException;
use App\Models\User;
use App\Repositories\User\Abstracts\UserRepositoryInterface;
use App\Services\Api\Auth\Abstracts\AuthServiceInterface;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @inheritDoc
     */
    public function restore(SendData $data): Response
    {
        $status = Password::sendResetLink(
          $data->toArray()
        );

        if ($status === Password::RESET_LINK_SENT){
            return response('Запрос был отправлен', 201);
        }
        else{
            throw new DefaultException();
        }
    }

    public function restoreConfirm(RestoreConfirmData $data): Response
    {
        $status = Password::reset(
            $data->toArray(),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET){
            return response('Пользователь успешно сменил пароль', 201);
        }else{
            throw new DefaultException();
        }
    }
}
