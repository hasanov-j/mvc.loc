<?php

namespace App\Seed;

use App\Models\DishIngredient;

class DishIngredientSeed implements SeedInterface
{
    const DISH_INGREDIENT = [
        [
            'id_dishes' => 1,
            'id_ingredients' => 1,
        ],
        [
            'id_dishes' => 1,
            'id_ingredients' => 2,
        ],

        [
            'id_dishes' => 1,
            'id_ingredients' => 3,
        ],

        [
            'id_dishes' => 1,
            'id_ingredients' => 4,
        ],

        [
            'id_dishes' => 1,
            'id_ingredients' => 5,
        ],

        [
            'id_dishes' => 1,
            'id_ingredients' => 6,
        ],

        [
            'id_dishes' => 1,
            'id_ingredients' => 7,
        ],

        [
            'id_dishes' => 2,
            'id_ingredients' => 1,
        ],
        [
            'id_dishes' => 2,
            'id_ingredients' => 7,
        ],

        [
            'id_dishes' => 2,
            'id_ingredients' => 8,
        ],

        [
            'id_dishes' => 2,
            'id_ingredients' => 9,
        ],

        [
            'id_dishes' => 2,
            'id_ingredients' => 10,
        ],

        [
            'id_dishes' => 2,
            'id_ingredients' => 11,
        ],

        [
            'id_dishes' => 2,
            'id_ingredients' => 12,
        ],

        [
            'id_dishes' => 2,
            'id_ingredients' => 13,
        ],

        [
            'id_dishes' => 3,
            'id_ingredients' => 1,
        ],

        [
            'id_dishes' => 3,
            'id_ingredients' => 4,
        ],

        [
            'id_dishes' => 3,
            'id_ingredients' => 12,
        ],

        [
            'id_dishes' => 3,
            'id_ingredients' => 14,
        ],

        [
            'id_dishes' => 3,
            'id_ingredients' => 15,
        ],

        [
            'id_dishes' => 4,
            'id_ingredients' => 16,
        ],

        [
            'id_dishes' => 4,
            'id_ingredients' => 17,
        ],

        [
            'id_dishes' => 4,
            'id_ingredients' => 18,
        ],

        [
            'id_dishes' => 4,
            'id_ingredients' => 18,
        ],

        [
            'id_dishes' => 4,
            'id_ingredients' => 19,
        ],

        [
            'id_dishes' => 4,
            'id_ingredients' => 12,
        ],

        [
            'id_dishes' => 4,
            'id_ingredients' => 2
        ],

        [
            'id_dishes' => 5,
            'id_ingredients' => 21,
        ],

        [
            'id_dishes' => 5,
            'id_ingredients' => 1,
        ],

        [
            'id_dishes' => 5,
            'id_ingredients' => 9,
        ],

        [
            'id_dishes' => 5,
            'id_ingredients' => 22,
        ],

        [
            'id_dishes' => 5,
            'id_ingredients' => 4,
        ],

        [
            'id_dishes' => 5,
            'id_ingredients' => 10,
        ],

        [
            'id_dishes' => 5,
            'id_ingredients' => 11,
        ],

        [
            'id_dishes' => 5,
            'id_ingredients' => 12,
        ],

        [
            'id_dishes' => 5,
            'id_ingredients' => 23,
        ],

        [
            'id_dishes' => 5,
            'id_ingredients' => 24,
        ],

        [
            'id_dishes' => 6,
            'id_ingredients' => 7,
        ],

        [
            'id_dishes' => 6,
            'id_ingredients' => 17,
        ],

        [
            'id_dishes' => 6,
            'id_ingredients' => 9,
        ],

        [
            'id_dishes' => 6,
            'id_ingredients' => 22,
        ],

        [
            'id_dishes' => 6,
            'id_ingredients' => 25,
        ],

        [
            'id_dishes' => 6,
            'id_ingredients' => 26,
        ],

        [
            'id_dishes' => 6,
            'id_ingredients' => 23,
        ],

        [
            'id_dishes' => 7,
            'id_ingredients' => 27,
        ],

        [
            'id_dishes' => 7,
            'id_ingredients' => 4,
        ],

        [
            'id_dishes' => 7,
            'id_ingredients' => 28,
        ],

        [
            'id_dishes' => 7,
            'id_ingredients' => 29,
        ],

        [
            'id_dishes' => 7,
            'id_ingredients' => 30,
        ],

        [
            'id_dishes' => 7,
            'id_ingredients' => 6,
        ],


        [
            'id_dishes' => 8,
            'id_ingredients' => 31,
        ],

        [
            'id_dishes' => 8,
            'id_ingredients' => 32,
        ],

        [
            'id_dishes' => 8,
            'id_ingredients' => 33,
        ],

        [
            'id_dishes' => 9,
            'id_ingredients' => 34,
        ],

        [
            'id_dishes' => 9,
            'id_ingredients' => 28,
        ],

        [
            'id_dishes' => 9,
            'id_ingredients' => 35,
        ],

        [
            'id_dishes' => 10,
            'id_ingredients' => 34,
        ],

        [
            'id_dishes' => 10,
            'id_ingredients' => 30,
        ],

        [
            'id_dishes' => 10,
            'id_ingredients' => 28,
        ],

        [
            'id_dishes' => 11,
            'id_ingredients' => 36,
        ],

        [
            'id_dishes' => 11,
            'id_ingredients' => 9,
        ],

        [
            'id_dishes' => 11,
            'id_ingredients' => 28,
        ],

        [
            'id_dishes' => 11,
            'id_ingredients' => 37,
        ],

        [
            'id_dishes' => 11,
            'id_ingredients' => 35,
        ],

        [
            'id_dishes' => 11,
            'id_ingredients' => 38,
        ],

        [
            'id_dishes' => 12,
            'id_ingredients' => 28,
        ],

        [
            'id_dishes' => 12,
            'id_ingredients' => 30,
        ],

        [
            'id_dishes' => 13,
            'id_ingredients' => 31,
        ],

        [
            'id_dishes' => 13,
            'id_ingredients' => 22,
        ],

        [
            'id_dishes' => 13,
            'id_ingredients' => 27,
        ],

        [
            'id_dishes' => 13,
            'id_ingredients' => 11,
        ],

        [
            'id_dishes' => 13,
            'id_ingredients' => 28,
        ],

        [
            'id_dishes' => 13,
            'id_ingredients' => 30,
        ],

        [
            'id_dishes' => 15,
            'id_ingredients' => 39,
        ],

        [
            'id_dishes' => 15,
            'id_ingredients' => 40,

        ],

        [
            'id_dishes' => 14,
            'id_ingredients' => 42,
        ],

        [
            'id_dishes' => 14,
            'id_ingredients' => 22,
        ],

        [
            'id_dishes' => 14,
            'id_ingredients' => 43,
        ],

        [
            'id_dishes' => 14,
            'id_ingredients' => 44,
        ],

        [
            'id_dishes' => 16,
            'id_ingredients' => 45,
        ],

        [
            'id_dishes' => 16,
            'id_ingredients' => 46,
        ],

        [
            'id_dishes' => 16,
            'id_ingredients' => 47,
        ],

        [
            'id_dishes' => 16,
            'id_ingredients' => 48,
        ],

        [
            'id_dishes' => 17,
            'id_ingredients' => 49,
        ],

        [
            'id_dishes' => 18,
            'id_ingredients' => 50,
        ],

        [
            'id_dishes' => 18,
            'id_ingredients' => 51,
        ],

        [
            'id_dishes' => 18,
            'id_ingredients' => 52,
        ],

        [
            'id_dishes' => 18,
            'id_ingredients' => 46,
        ],

        [
            'id_dishes' => 18,
            'id_ingredients' => 53,
        ],

        [
            'id_dishes' => 18,
            'id_ingredients' => 54,
        ],

        [
            'id_dishes' => 18,
            'id_ingredients' => 55,
        ],

        [
            'id_dishes' => 19,
            'id_ingredients' => 56,
        ],

        [
            'id_dishes' => 19,
            'id_ingredients' => 57,
        ],

        [
            'id_dishes' => 19,
            'id_ingredients' => 55,
        ],

        [
            'id_dishes' => 20,
            'id_ingredients' => 58,
        ],

        [
            'id_dishes' => 20,
            'id_ingredients' => 38,
        ],

        [
            'id_dishes' => 20,
            'id_ingredients' => 59,
        ],

        [
            'id_dishes' => 20,
            'id_ingredients' => 60,
        ],

        [
            'id_dishes' => 20,
            'id_ingredients' => 61,
        ],

        [
            'id_dishes' => 21,
            'id_ingredients' => 58,
        ],

        [
            'id_dishes' => 21,
            'id_ingredients' => 62,
        ],

        [
            'id_dishes' => 21,
            'id_ingredients' => 63,
        ],

        [
            'id_dishes' => 21,
            'id_ingredients' => 64,
        ],

        [
            'id_dishes' => 21,
            'id_ingredients' => 38,
        ],

        [
            'id_dishes' => 22,
            'id_ingredients' => 65,
        ],

        [
            'id_dishes' => 22,
            'id_ingredients' => 66,
        ],

        [
            'id_dishes' => 22,
            'id_ingredients' => 67,
        ],

        [
            'id_dishes' => 22,
            'id_ingredients' => 52,
        ],

        [
            'id_dishes' => 22,
            'id_ingredients' => 56,
        ],

        [
            'id_dishes' => 22,
            'id_ingredients' => 66,
        ],

        [
            'id_dishes' => 22,
            'id_ingredients' => 67,
        ],

    ];

    public static function up(): void
    {
        foreach (self::DISH_INGREDIENT as $item) {
            DishIngredient::create(
                idIngredients: $item['id_ingredients'],
                idDishes: $item['id_dishes'],
            );
        }
    }

    public static function down(): void
    {
        foreach (self::DISH_INGREDIENT as $item) {
            DishIngredient::deleteByDishesId(
                idDishes: $item['id_dishes']
            );
        }
    }

}