<?php

namespace App\Service\Auth\Exception\Web;

use App\Service\Auth\Exception\AuthException;

class AuthWebNotFoundException extends AuthWebException
{
    protected $code = 404;
}