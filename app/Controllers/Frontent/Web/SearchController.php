<?php

namespace App\Controllers\Frontent\Web;

use App\Components\Response;
use App\Models\CompanyInfo;
use App\Models\Contact;
use App\Models\Header;
use App\Models\SocialNetworks;

class SearchController
{
    public function index(){

        Response::view(viewPath: 'search/index.php',
            data:
            [
                'contact'=>Contact::getOneByUuid(uuid: '6eb2d063-5a1e-4f23-b6a6-90592fef6957'),
                'companyInfo'=>CompanyInfo::getInfo(),
                'socials'=>SocialNetworks::getALL(),
                'headers'=>Header::getALL(),
            ]
        );
    }
}