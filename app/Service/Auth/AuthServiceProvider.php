<?php

namespace App\Service\Auth;


class AuthServiceProvider implements AuthServiceProviderInterface
{
    public static function isAuth(AuthServiceInterface $auth): bool
    {
        return $auth->isAuth();
    }

    public static function isAuthCheck(AuthServiceInterface $auth)
    {
        $auth->isAuthCheck();
    }

    public static function findAuthUser(AuthServiceInterface $auth)
    {
        return $auth->findAuthUser();
    }

    public static function login(AuthServiceInterface $auth, string $email, string $password)
    {
        return $auth->login($email, $password);
    }

    public static function logout(AuthServiceInterface $auth)
    {
         $auth->logout();
    }
}