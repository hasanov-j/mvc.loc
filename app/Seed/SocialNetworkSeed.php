<?php

namespace App\Seed;

use App\Models\SocialNetworks;

class SocialNetworkSeed implements SeedInterface
{
    const SOCIAL_NETWORKS=[
        [
            'class_name'=>'fa-vk',
            'link'=>'https://vk.com/thebullmsk',
            'uuid'=>'30178145-3f17-454d-a6d2-f04044cf3a2a'
        ],

        [
            'class_name'=>'fa-telegram',
            'link'=>'https://t.me/bullmyaso',
            'uuid'=>'d7ae6ecc-6277-4859-981f-9c0870a75b5a'
        ],

    ];

    public static function up(){
        foreach (self::SOCIAL_NETWORKS as $socialNetwork)
        {
            SocialNetworks::create(
                className: $socialNetwork['class_name'],
                link: $socialNetwork['link'],
                uuid:$socialNetwork['uuid']
            );
        }

    }

    public static function down(){
        foreach (self::SOCIAL_NETWORKS as $socialNetwork)
        {
            SocialNetworks::deleteByUuid(
                uuid:$socialNetwork['uuid']
            );
        }

    }

}