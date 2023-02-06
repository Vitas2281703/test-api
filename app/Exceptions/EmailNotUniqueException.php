<?php

namespace App\Exceptions;

use Exception;

class EmailNotUniqueException extends Exception
{
    protected string $error = 'Пользователь с такой почтой уже существует';
    protected int $statusCode = 409;
}
