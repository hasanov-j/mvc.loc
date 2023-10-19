<?php

namespace App\Seed;

use App\Models\Sliders;

class SliderSeed implements SeedInterface
{
    const SLIDERS=[
        [
            'name'=>'Сеть Демократических Мясных Ресторанов',
            'description'=>'Вы часто можете услышать, что стейки доступны не для всех, но для нас это миф.
                          Мы считаем, что хорошее мясо может и должно быть доступно. И эта идея лежит в основе
                          нашей ресторанной концепции',
            'className'=>'carousel-item active',
            'linkName'=>'Заказать',
            'link'=>'/products',
            'uuid'=>'bb2d8ce7-223e-43f5-a0c5-d82c879111dc',
        ],

        [
            'name'=>'Сеть Демократических Мясных Ресторанов',
            'description'=>'Нежные стейки из мраморной говядины, приготовленные в испанской печи josper,
                         сочный шашлык, аппетитные бургеры – это только малая доля того, чем мы можем вас порадовать.',
            'className'=>'carousel-item',
            'linkName'=>'Заказать',
            'link'=>'/products',
            'uuid'=>'2f37f4d6-99ae-4412-b9bd-e35db845e869',
        ],

    ];

    public static function up(): void
    {
        foreach (self::SLIDERS as $slider){
            Sliders::create(
                name: $slider['name'],
                description: $slider['description'],
                className: $slider['className'],
                linkName: $slider['linkName'],
                link: $slider['link'],
                uuid:$slider['uuid']
            );
        }
    }

    public static function down(): void
    {
        foreach (self::SLIDERS as $slider){
            Sliders::deleteByUuid(
                uuid: $slider['uuid']
            );
        }
    }
}