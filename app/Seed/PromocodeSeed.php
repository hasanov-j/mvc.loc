<?php

namespace App\Seed;

use App\Exception\ModelException\ModelInsertErrorException;
use App\Exception\SeedException\SeedInsertErrorException;
use App\Models\Promocode;

class PromocodeSeed implements SeedInterface
{
    const PROMOCODES = [

        [
            'title' => 'ЮБИЛЕЙ',
            'description' => "Самое выгодное предложение, получи скидку на 35%",
            'url_img' => "/public/promocodes/five_big_pizza.png",
            'discount' => 35,
            'value' => '5050',
            'is_advertising' => 1,
        ],

        [
            'title' => 'ОСЕНЬ',
            'description' => "Не хондри, держи скидку на 25%",
            'url_img' => "/public/promocodes/two_big_pizza.png",
            'discount' => 25,
            'value' => '2020',
            'is_advertising' => 1,
        ],
    ];

    public static function up()
    {
        foreach (self::PROMOCODES as $promocode) {
            try {
                Promocode::create(
                    title: $promocode['title'],
                    description: $promocode['description'],
                    url_img: $promocode['url_img'],
                    discount: $promocode['discount'],
                    value: $promocode['value'],
                    is_advertising: $promocode['is_advertising']
                );
            } catch (ModelInsertErrorException $exception){
                throw new SeedInsertErrorException($exception->getMessage());
            }

        }
    }

    public static function down()
    {
        foreach (self::PROMOCODES as $promocode) {
            Promocode::getOneByValue($promocode['value']);
        }
    }
}