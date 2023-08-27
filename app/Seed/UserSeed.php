<?php

declare(strict_types=1);

namespace App\Seed;

use App\Components\ConsoleColorize;
use App\Models\User;

class UserSeed
{
    public static function up()
    {
         $Users=[
            [
                'lastname'=>'Wick',
                'firstname'=>'Jon',
                'age'=>46,
                'phone'=>'+14568124455',
                'country'=>'USA',
                'city'=>'New-York'
            ],

             [
                 'lastname'=>'Kiddo',
                 'firstname'=>'Beatrix',
                 'age'=>30,
                 'phone'=>'+16578127478',
                 'country'=>'USA',
                 'city'=>'New Orleans'
             ],

             [
                 'lastname'=>'Ishii',
                 'firstname'=>"O'ren",
                 'age'=>30,
                 'phone'=>'+81901545678',
                 'country'=>'Japan',
                 'city'=>'Tokio'
             ],

             [
                 'lastname'=>'Ilyin',
                 'firstname'=>'Evgeni',
                 'age'=>24,
                 'phone'=>'+79456874511',
                 'country'=>'Russia',
                 'city'=>'Moscow'
             ],

             [
                 'lastname'=>'Berdiev',
                 'firstname'=>'Oman',
                 'age'=>24,
                 'phone'=>'+79999518037',
                 'country'=>'Russia',
                 'city'=>'Moscow'
             ],

             [
                 'lastname'=>'Jaylipka',
                 'firstname'=>'Ykbal',
                 'age'=>66,
                 'phone'=>'+99364581243',
                 'country'=>'Turkmenistan',
                 'city'=>'Turkmenabat'
             ],

             [
                 'lastname'=>'Pedchenko',
                 'firstname'=>'Victor',
                 'age'=>25,
                 'phone'=>'+78546605884',
                 'country'=>'Russia',
                 'city'=>'Krasnodar'
             ],

             [
                 'lastname'=>'Rozymuradov',
                 'firstname'=>'Rustam',
                 'age'=>24,
                 'phone'=>'+99365454507',
                 'country'=>'Turkmenistan',
                 'city'=>'Denav'
             ],

             [
                 'lastname'=>'Fedorova',
                 'firstname'=>'Anastasia',
                 'age'=>24,
                 'phone'=>'+79994891233',
                 'country'=>'Russia',
                 'city'=>'Samara'
             ],
        ];

        foreach ($Users as $user){
            User::create(
                firstname:  $user['firstname'],
                lastname: $user['lastname'],
                age: $user['age'],
                phone: $user['phone'],
                country: $user['country'],
                city: $user['city']
            );
        }
        ConsoleColorize::print(
            text: 'Users data add successfully',
            color: ConsoleColorize::GREEN
        );

    }
}