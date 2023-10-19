<?php

namespace App\Controllers\Frontent\Web;

use App\Components\Response;
use App\Models\About;
use App\Models\AuthUser;
use App\Models\CompanyInfo;
use App\Models\Contact;
use App\Models\Header;
use App\Models\SocialNetworks;

class FeedbackController
{
    public function index(){
        $infoAbout=About::getInfo();
        $contact=Contact::getOneByUuid(uuid: '6eb2d063-5a1e-4f23-b6a6-90592fef6957');
        $companyInfo=CompanyInfo::getInfo();
        $socials=SocialNetworks::getALL();
        $headers=Header::getALL();

        Response::view('book/bookTable.php', [
            'infoAbout'=> $infoAbout,
            'contact'=> $contact,
            'companyInfo'=> $companyInfo,
            'socials'=> $socials,
            'headers'=> $headers,
        ]);

    }
}