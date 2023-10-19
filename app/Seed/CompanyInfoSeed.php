<?php

namespace App\Seed;

use App\Models\CompanyInfo;

class CompanyInfoSeed implements SeedInterface
{
    const COMPANY_INFO=[
        'description'=> 'Мясной ресторан "THE БЫК" распахивает свои двери для всех гурманов мяса. 
                        Здесь вы сможете насладиться блюдами одних из лучших поваров страны.',
        'name'=>'The Бык',
        'days'=>'Каждый день',
        'time'=>'10-00 до 22-00'
    ];

    public static function up(){
            CompanyInfo::create(
                description: self::COMPANY_INFO['description'],
                name: self::COMPANY_INFO['name'],
                days: self::COMPANY_INFO['days'],
                time: self::COMPANY_INFO['time']
            );
    }

    public static function down(){

            CompanyInfo::deleteByName(self::COMPANY_INFO['name']);

    }

}