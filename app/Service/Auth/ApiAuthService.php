<?php

namespace App\Service\Auth;

use App\Models\User;

class ApiAuthService implements AuthServiceInterface
{
    public function isAuthCheck(): ?bool
    {
        return false;
    }

    public function findAuthUser()
    {
       return null;
    }
}