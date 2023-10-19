<?php

namespace App\Controllers\Frontent\Web;

use App\Components\Redirect;
use App\Components\Request;
use App\Components\Response;
use App\Components\Session;
use App\Models\CompanyInfo;
use App\Models\Contact;
use App\Models\Header;
use App\Models\SocialNetworks;
use App\Service\Auth\AuthServiceProvider;
use App\Service\Auth\Exception\Web\AuthWebException;
use App\Service\Auth\WebAuthService;

class AuthController
{
    private WebAuthService $webAuthService;

    public function __construct() {
        $this->webAuthService=new WebAuthService;
    }
    public function index(): void
    {
        $errors=null;

        if(array_key_exists('errors',$_SESSION)){
            $errors=Session::get('errors');
        }

        Response::view(
            viewPath: 'login/index.php',
            data: [
                'errors' => $errors,
                'contact'=>Contact::getOneByUuid(uuid: '6eb2d063-5a1e-4f23-b6a6-90592fef6957'),
                'companyInfo'=>CompanyInfo::getInfo(),
                'socials'=>SocialNetworks::getALL(),
                'headers'=>Header::getALL(),
            ]
        );
    }

    public function login(): void
    {
        $errors = [];

        $authData = Request::getContent();

        $email = $authData['email'] ?? null;

        $password = $authData['password'] ?? null;

        if ($email == null || $password == null) {
            $errors[]= 'Введите ваш email или пароль';
            Session::set('errors', $errors);
            Redirect::back();die;
        }

        try {
            AuthServiceProvider::login($this->webAuthService, $email, $password);
            Redirect::main();
        } catch (AuthWebException $exception) {
            $errors[] = 'Неверно введен пароль или адрес электронный почты';
            Session::set('errors', $errors);
            Redirect::back();
        }
    }

    public function logout(): void
    {
        AuthServiceProvider::logout($this->webAuthService);
        Redirect::back();
    }
}