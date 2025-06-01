<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Throwable;

class Handler extends Exception
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthorizationException) {
            return view('errors.403');
        }

        return parent::render($request, $exception);
    }
}
