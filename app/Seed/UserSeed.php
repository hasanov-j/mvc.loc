<?php

declare(strict_types=1);

namespace App\Seed;

use App\Components\ConsoleColorize;
use App\Models\User;
use Ramsey\Uuid\Uuid;

class UserSeed
{

    const USERS = [
        [
            'lastname' => 'Wick',
            'firstname' => 'Jon',
            'age' => 46,
            'phone' => '+14568124455',
            'country' => 'USA',
            'city' => 'New-York',
            'uuid' => '17a01071-6b35-4a2e-a646-cc490ca193a7',
        ],

        [
            'lastname' => 'Kiddo',
            'firstname' => 'Beatrix',
            'age' => 30,
            'phone' => '+16578127478',
            'country' => 'USA',
            'city' => 'New Orleans',
            'uuid' => '24d6375c-99d8-44cf-a21f-a557cd59e61a',
        ],

        [
            'lastname' => 'Ishii',
            'firstname' => "O'ren",
            'age' => 30,
            'phone' => '+81901545678',
            'country' => 'Japan',
            'city' => 'Tokio',
            'uuid' => 'b40c0975-5169-4780-9e54-e10aab5e9edd',
        ],

        [
            'lastname' => 'Ilyin',
            'firstname' => 'Evgeni',
            'age' => 24,
            'phone' => '+79456874511',
            'country' => 'Russia',
            'city' => 'Moscow',
            'uuid' => 'cb25ef3e-7b52-42bd-8ec6-1cc858d90614',
        ],

        [
            'lastname' => 'Berdiev',
            'firstname' => 'Oman',
            'age' => 24,
            'phone' => '+79999518037',
            'country' => 'Russia',
            'city' => 'Moscow',
            'uuid' => '17ddcd8c-7948-4ef7-a264-8748ec60484c',
        ],

        [
            'lastname' => 'Jaylipka',
            'firstname' => 'Ykbal',
            'age' => 66,
            'phone' => '+99364581243',
            'country' => 'Turkmenistan',
            'city' => 'Turkmenabat',
            'uuid' => '873689ff-d3ad-4af7-ae55-58f04a05ce3c',
        ],

        [
            'lastname' => 'Pedchenko',
            'firstname' => 'Victor',
            'age' => 25,
            'phone' => '+78546605884',
            'country' => 'Russia',
            'city' => 'Krasnodar',
            'uuid' => '753dca54-00f6-41f3-8681-00d2d92967dd',
        ],

        [
            'lastname' => 'Rozymuradov',
            'firstname' => 'Rustam',
            'age' => 24,
            'phone' => '+99365454507',
            'country' => 'Turkmenistan',
            'city' => 'Denav',
            'uuid' => '01caae67-f5cf-49bb-9def-ad8b32112e2a',
        ],

        [
            'lastname' => 'Fedorova',
            'firstname' => 'Anastasia',
            'age' => 24,
            'phone' => '+79994891233',
            'country' => 'Russia',
            'city' => 'Samara',
            'uuid' => '54f759a8-00eb-49cf-b52a-910282c9ea13',
        ],
    ];

    public static function up()
    {
        foreach (self::USERS as $key => $user) {

            ConsoleColorize::print(
                text: 'Users creating' . str_repeat(".", $key),
                color: ConsoleColorize::BLUE
            );

            try {
                User::create(
                    firstname: $user['firstname'],
                    lastname: $user['lastname'],
                    age: $user['age'],
                    phone: $user['phone'],
                    country: $user['country'],
                    city: $user['city'],
                    uuid: Uuid::fromString($user['uuid'])->toString(),
                );
            } catch (\PDOException $exception) {
                ConsoleColorize::print(
                    text: $exception->getMessage(),
                    color: ConsoleColorize::RED
                );
                die;
            }

        }
        ConsoleColorize::print(
            text: 'Users data add successfully',
            color: ConsoleColorize::GREEN
        );
    }

    public static function down()
    {
        ConsoleColorize::print(
            text: 'Users data remove',
            color: ConsoleColorize::BLUE
        );

        foreach (self::USERS as $key => $user) {

            ConsoleColorize::print(
                text: 'Users deleting' . str_repeat(".", $key),
                color: ConsoleColorize::BLUE
            );


            User::deleteByUuid($user['uuid']);
        }

        ConsoleColorize::print(
            text: 'Users data remove successfully',
            color: ConsoleColorize::GREEN
        );
    }
}