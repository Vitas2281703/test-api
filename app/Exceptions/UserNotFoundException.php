<?php

namespace App\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    protected string $error = 'Пользователь с таким токеном не найден';
    protected int $statusCode = 404;
}
