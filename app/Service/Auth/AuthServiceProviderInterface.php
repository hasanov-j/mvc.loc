<?php

namespace App\Service\Auth;

use App\Models\User;

interface AuthServiceProviderInterface
{
    public static function isAuth(AuthServiceInterface $auth): bool;
    public static function isAuthCheck(AuthServiceInterface $auth);

    public static function findAuthUser(AuthServiceInterface $auth);
    public static function login(AuthServiceInterface $auth, string $email, string $password);
    public static function logout(AuthServiceInterface $auth);
}