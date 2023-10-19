<?php

namespace App\Seed;

use App\Models\User;

class UserSeed implements SeedInterface
{
    const USERS=[

        [
            'firstname'=>'Артемий',
            'lastname'=>'Сарделькин',
            'phone'=>'+375256752233',
            'email'=>'sardelka@mail.ru',
            'password'=>'1234',
            'avatar'=>'/upload/avatars/sardelkyn.jpg',
            'uuid'=>'77c8c985-9c7a-4a6f-aa45-6b40748a0e66'
        ],

        [
            'firstname'=>'Альберт',
            'lastname'=>'Карпович',
            'phone'=>'+79060400993',
            'email'=>'albertokarp@mail.ru',
            'password'=>'1234',
            'avatar'=>'/upload/avatars/albert.jpg',
            'uuid'=>'565f5aa3-1ace-498a-a236-3aefb91cdc66'
        ],

        [
            'firstname'=>'Элли',
            'lastname'=>'Виллиамс',
            'phone'=>'+79991652141',
            'email'=>'williams.e@mail.ru',
            'password'=>'1234',
            'avatar'=>'/upload/avatars/ellie.jpg',
            'uuid'=>'e5b18078-3873-40a3-9288-2591b9ab1908'
        ],

        [
            'firstname'=>'Герман',
            'lastname'=>'Маджахедов',
            'phone'=>'+79081218458',
            'email'=>'germaja@mail.ru',
            'password'=>'1234',
            'avatar'=>'/upload/avatars/german.jpg',
            'uuid'=>'c7e3241b-b138-4a73-905e-f9e87a282d0f'
        ],

    ];

    public static function up(){

        foreach (self::USERS as $user){
            User::create(
                firstname: $user['firstname'],
                lastname: $user['lastname'],
                phone: $user['phone'],
                email: $user['email'],
                password: $user['password'],
                avatar: $user['avatar'],
                uuid: $user['uuid'],
            );
        }

    }
    public static function down(){
        foreach (self::USERS as $user){
            User::deleteByUuid($user['uuid']);
        }
    }
}