<?php
namespace App\Domains\Actions\Exceptions;

use Exception;

class InvalidActionException extends Exception
{
    protected $code = 422;
}
