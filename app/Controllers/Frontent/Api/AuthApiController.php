<?php

namespace App\Controllers\Frontent\Api;

use App\Components\Response;
use App\Controllers\Api\Session;
use App\Models\AuthUser;
use App\Service\Auth\ApiAuthService;
use App\Service\Auth\AuthServiceProvider;

class AuthApiController
{

    public function __construct()
    {
        AuthServiceProvider::isAuthCheck(new ApiAuthService());
    }


    public function index()
    {

        if (!AuthUser::isAuth(sessionUuid: Session::get('PHPSESSID'))) {

            AuthUser::create(
                sessionUuid: Session::get('PHPSESSID'),
                id_users: $idUsers,
                is_active: 0
            );

        } else {
            Response::json(content: ['Пользаватель с такими данными уже существует']);
        }
    }
}