<?php

namespace App\Service\Auth\Exception\Web;

use App\Service\Auth\Exception\AuthException;

class AuthWebForbiddenException extends AuthWebException
{
    protected $code = 403;
}