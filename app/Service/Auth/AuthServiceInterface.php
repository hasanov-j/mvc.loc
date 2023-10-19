<?php

namespace App\Service\Auth;

use App\Models\User;

interface AuthServiceInterface
{
    public function isAuth(): bool;
    public function isAuthCheck();

    public function findAuthUser();

    public function login(string $email, string $password);

    public function logout();
}