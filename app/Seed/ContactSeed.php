<?php

namespace App\Seed;

use App\Models\Contact;

class ContactSeed
{
    const CONTACTS = [
        [
            'location' => 'г. Москва, ул. Профсоюзная, д.64, к.2, эт.3',
            'phone' => '+74959881717',
            'email' => 'byk.profsoyuz@mail.ru',
            'uuid' => '6eb2d063-5a1e-4f23-b6a6-90592fef6957',
        ],

    ];

    public static function up()
    {
        foreach (self::CONTACTS as $contact) {
            Contact::create(
                location: $contact['location'],
                phone: $contact['phone'],
                email: $contact['email'],
                uuid: $contact['uuid']
            );
        }

    }

    public static function down()
    {
        foreach (self::CONTACTS as $contact) {
            Contact::deleteByUuid($contact['uuid']);
        }
    }
}