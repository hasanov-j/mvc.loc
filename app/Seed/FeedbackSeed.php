<?php

namespace App\Seed;

use App\Models\Feedback;

class FeedbackSeed implements SeedInterface
{
    const COMMENTS=[

        [
            'id_users'=>2,
            'firstname'=>'Кирил',
            'lastname'=>'Комардин',
            'comment'=>'отличное место, буду рекомендовать своим друзьям))',
            'phone'=>'+375256664879',
            'uuid'=>'fdef30e6-24ed-4469-bf2c-70eb9dd04b71',
        ],

        [
            'id_users'=>3,
            'firstname'=>'Керим',
            'lastname'=>'Абдель',
            'comment'=>'в целом заведение приятное, больше всего понравились салаты, а имеенно стейк салат))',
            'phone'=>'+375224569916',
            'uuid'=>'5defaa5d-d84a-431a-857e-5e5d0a107781',
        ],

        [
            'id_users'=>1,
            'firstname'=>'Иван',
            'lastname'=>'Васильев',
            'comment'=>'еда очень вкусная, но интерьер не очень, нужно что-то делать',
            'phone'=>'+375256752233',
            'uuid'=>'2dd3222b-db43-4320-bc5d-a31c4e2dd9bf',
        ],

        [
            'id_users'=>null,
            'firstname'=>'Иванка',
            'lastname'=>'Трамп',
            'comment'=>'буду рекомендовать друзьям',
            'phone'=>'+375256661288',
            'uuid'=>'dcfefc70-83fa-49c7-89a2-aa6f7c8c648e',
        ],

    ];

    public static function up(){

        foreach (self::COMMENTS as $comment){
            Feedback::create(
                id_users: $comment['id_users'],
                firstname: $comment['firstname'],
                lastname: $comment['lastname'],
                comment: $comment['comment'],
                phone: $comment['phone'],
                uuid: $comment['uuid']
            );
        }

    }
    public static function down(){
        foreach (self::COMMENTS as $comment){
            Feedback::deleteByUuid(
                uuid: $comment['uuid']
            );
        }
    }
}