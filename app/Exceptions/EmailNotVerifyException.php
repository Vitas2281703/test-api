<?php

namespace App\Exceptions;

use Exception;

class EmailNotVerifyException extends Exception
{
    protected string $error = 'Пользователь не подтвердил почту';
    protected int $statusCode = 406;

}
