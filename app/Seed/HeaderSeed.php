<?php

namespace App\Seed;

use App\Models\Header;

class HeaderSeed implements SeedInterface
{
    const HEADERS =[
        [
            'name'=>'Главная',
            'url'=>'/',
            'uuid'=>'18cceb69-c4f2-4993-b514-ce7d8384908d',
        ],

        [
            'name'=>'Меню',
            'url'=>'/products',
            'uuid'=>'df9450e9-bb83-40c1-9b20-af607111873c',
        ],

        [
            'name'=>'О нас',
            'url'=>'/about',
            'uuid'=>'2a68de62-85e3-4d17-9265-12c24f106b21',
        ],

        [
            'name'=>'Книга отзывов',
            'url'=>'/feedbacks',
            'uuid'=>'aad3e9d7-c189-496a-8a30-2187ad51edec',
        ],

        [
            'name'=>'Регистрация',
            'url'=>'/reg',
            'uuid'=>'df403d6e-fbd2-4520-8d73-8b65be669a63',
        ],

        [
            'name'=>'Выйти',
            'url'=>'/logout',
            'uuid'=>'e78ae383-8147-4f45-94f5-a20d946126fc',
        ],
    ];

    public static function up(){
        foreach (self::HEADERS as $header)
        Header::create(
            name: $header['name'],
            url: $header['url'],
            uuid: $header['uuid'],
        );
    }

    public static function down()
    {
        foreach (self::HEADERS as $header){
            Header::deleteByUuid(
                uuid: $header['uuid']
            );
        }
    }

}