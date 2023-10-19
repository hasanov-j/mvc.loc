<?php

declare(strict_types=1);

Namespace App\Seed;

use App\Models\Category;

class CategorySeed implements SeedInterface
{
    const CATEGORIES=[
        [
            'uuid'=>'d488c526-685e-4845-85c9-4dcf922ad52f',
            'name'=>'Бургеры',
        ],

        [
            'uuid'=>'b0a71534-bbdb-4f52-935a-98085567dcb3',
            'name'=>'Пицца',
        ],

        [
            'uuid'=>'cb1a4d77-84d4-4af2-99ba-f1b301eedaea',
            'name'=>'Паста',
        ],

        [
            'uuid'=>'124e7d26-c87b-4185-9aa0-4251c28a1981',
            'name'=>'Салаты',
        ],

        [
            'uuid'=>'b28da960-9e2f-43b6-982b-1f8bf69dba6f',
            'name'=>'Напитки',
        ],

    ];

    public static function up(){
        foreach (self::CATEGORIES as $category){
            Category::create(
                name: $category['name'],
                uuid: $category['uuid']
            );
        }
    }

    public static function down(){

        foreach (self::CATEGORIES as $category){
            Category::deleteByUuid($category['uuid']);
        }

    }
}