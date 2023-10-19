<?php

namespace App\Controllers\Frontent\Web;

use App\Components\Response;
use App\Models\About;
use App\Models\CompanyInfo;
use App\Models\Contact;
use App\Models\Header;
use App\Models\Sliders;
use App\Models\SocialNetworks;
use App\Service\Auth\AuthServiceProvider;
use App\Service\Auth\WebAuthService;

class MainController
{
    public function __construct()
    {
        //AuthServiceProvider::isAuthCheck(new WebAuthService);
    }

    public function index(){

        Response::view(
            viewPath: 'main/index.php',
            data: [
                'headers'=>Header::getALL(),
                'sliders'=>Sliders::getALL(),
                'infoAbout'=>About::getInfo(),
                'contact'=>Contact::getOneByUuid(uuid: '6eb2d063-5a1e-4f23-b6a6-90592fef6957'),
                'companyInfo'=>CompanyInfo::getInfo(),
                'socials'=>SocialNetworks::getALL(),
            ]
        );
    }
}