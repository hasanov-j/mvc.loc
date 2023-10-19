<?php

namespace App\Controllers\Frontent\Web;

use App\Components\Response;
use App\Models\CompanyInfo;
use App\Models\Contact;
use App\Models\Header;
use App\Models\SocialNetworks;

class ProductController
{
    public function index()
    {
        Response::view(
            viewPath: 'products/index.php',
            data: [
                'headers'=>Header::getALL(),
                'companyInfo'=>CompanyInfo::getInfo(),
                'socials'=>SocialNetworks::getALL(),
                'contact'=>Contact::getOneByUuid(uuid: '6eb2d063-5a1e-4f23-b6a6-90592fef6957'),
            ]
        );
    }

}