<?php

namespace App\Exceptions;

use Exception;

class WrongLoginDataException extends Exception
{
    protected string $error = 'Ошибка в заполнении данных';
    protected int $statusCode  = 408;
}
