<?php

namespace App\Exceptions;

use Exception;

class DefaultException extends Exception
{
    protected string $error = 'Any expected error';
}
