<?php

namespace App\Controllers\Frontent\Web;

use App\Components\Cookie;
use App\Components\FileManager;
use App\Components\Redirect;
use App\Components\Request;
use App\Components\Response;
use App\Components\Session;
use App\Exception\ModelException\ModelNotFoundException;
use App\Models\CompanyInfo;
use App\Models\Contact;
use App\Models\Header;
use App\Models\SessionManager;
use App\Models\SocialNetworks;
use App\Models\User;
use Ramsey\Uuid\Uuid;

class RegistrationController
{

    public function index()
    {
        $errors=null;
        if(array_key_exists('errors',$_SESSION)){
            $errors=Session::get('errors');
        }

        Response::view('/reg/index.php',
            [
                'contact' => Contact::getOneByUuid(uuid: '6eb2d063-5a1e-4f23-b6a6-90592fef6957'),
                'companyInfo' => CompanyInfo::getInfo(),
                'socials' => SocialNetworks::getALL(),
                'headers' => Header::getALL(),
                'errors' => $errors,
            ]
        );
    }

    public function store()
    {

        $requestData = Request::getContent();
        $clientIpAddress = Request::getClientIp();
        $avatarData = $_FILES['avatar'];
        $errors = [];


        if (empty($avatarData['tmp_name'])) {
            $avatarPath = AVATARS_ROOT . 'default_profile_pic.jpg';
        } else {
            $avatarPath = FileManager::upload($avatarData);
        }


        if (!preg_match("/^[A-Za-z]+$/", $requestData['firstname'] ?? "")) {
            $errors[] = "Неверно введено имя пользователя, пожалуйста, повторите попытку";
        }

        if (!preg_match("/^[A-Za-z]+$/", $requestData['lastname'] ?? "")) {
            $errors[] = "Неверно введена фамилия пользователя, пожалуйста, повторите попытку";
        }

        if (!preg_match("/^\+375[0-9]{9}$/", $requestData['phone'] ?? "")) {
            $errors[] = "Неверно введен номер телефона, пожалуйста, повторите попытку";
        }

        if (!preg_match("/^[a-z][a-zA-z0-9_\-\.]{4,30}@[a-z]{2,7}\.[a-z]{2,3}$/", $requestData['email'] ?? "")) {
            $errors[] = "Неверно введен адрес электронной почты, пожалуйста, повторите попытку";
        }

        if (!preg_match("/^.{6,30}$/", $requestData['password'] ?? "")) {
            $errors[] = "Пожалуйста, введите безопасный пароль";
        }


        if ($errors == null) {

            if (User::isUserWithEmailExists($requestData['email'])) {
                $errors[] = 'Пользователь с такими данными уже существует';
                Session::set(name: 'errors', value: $errors);
                Redirect::back();
                die;

            } else {

                $userUuid = Uuid::uuid4()->toString();

                User::create(
                    firstname: $requestData['firstname'],
                    lastname: $requestData['lastname'],
                    phone: $requestData['phone'],
                    email: $requestData['email'],
                    password: $requestData['password'],
                    avatar: $avatarPath,
                    uuid: $userUuid
                );

                try {
                    $userId = User::findIdByUuid($userUuid);
                } catch (ModelNotFoundException $exception) {
                    $errors[] = 'Произошла ошибка при регистрации, пожалуйста, повторите попытку еще раз';
                    Session::set(name: 'errors', value: $errors);
                    Redirect::back();
                    die;
                }

                $sessionUuid = Uuid::uuid4()->toString();

                SessionManager::create(
                    idUsers: $userId,
                    ip: $clientIpAddress,
                    sessionUuid: $sessionUuid
                );

                Cookie::set(
                    name: "SESSION_UUID",
                    value: $sessionUuid,
                    timeInSeconds: 86400 * 150
                );

                Redirect::main();
            }

        } else {
            Session::set(name: 'errors', value: $errors);
            Redirect::back();
        }
    }
}