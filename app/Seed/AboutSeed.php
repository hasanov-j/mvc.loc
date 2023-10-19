<?php

namespace App\Seed;

use App\Models\About;

class AboutSeed
{
    const ABOUT=[
        'title'=> 'Мы "The Бык"',
        'description'=>'Первый ресторан «The Бык» был открыт в Калуге в 2016 году. 
                        Очень скоро он стал любимым местом истинных мясоедов.
                        С 2018 года одноимённые мясные рестораны начали открываться в Москве
                        и быстро завоевали любовь жителей и гостей столицы.',
        'imageUrl'=>'/public/images/about.jpg',
    ];

    public static function up(){
        About::create(
            title: self::ABOUT['title'],
            description: self::ABOUT['description'],
            imageUrl: self::ABOUT['imageUrl']
        );
    }

    public static function down(){

        About::deleteByTitle(self::ABOUT['title']);

    }
}