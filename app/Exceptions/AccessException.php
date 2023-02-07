<?php

namespace App\Exceptions;

use Exception;

class AccessException extends Exception
{
    protected string $error = 'Нет доступа';
    protected int $statusCode = 403;
}
