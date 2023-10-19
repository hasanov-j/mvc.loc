<?php

namespace App\Seed;

use App\Models\Ingredient;

class IngredientSeed implements SeedInterface
{
    const INGREDIENTS = [
        [
            'name' => 'булочка бриошь',
            'uuid' => 'b1446516-e562-43f6-b5ec-affa53746cb0'
        ],

        [
            'name' => 'жареный сыр сулугуни',
            'uuid' => 'd0ddaacb-18ec-487e-8731-57b66cbd3179'
        ],

        [
            'name' => 'свежая руккола',
            'uuid' => '12846a53-fdd7-490c-bad5-af985a9b0d14'
        ],

        [
            'name' => 'спелый томат',
            'uuid' => '82abc97d-8828-4a90-912d-d25eb0099813'
        ],

        [
            'name' => 'соус бальзамик',
            'uuid' => 'f9bc6592-d0be-45b8-8b14-2394f9d67982'
        ],

        [
            'name' => 'соус песто',
            'uuid' => 'c47d8c32-5dbb-41f2-a577-dd004118edbb'
        ],

        [
            'name' => 'говяжья котлета',
            'uuid' => '8805b5b1-4cd9-4215-ae66-9c4c50cf46e5'
        ],

        [
            'name' => 'маринованная, рубленная говядина',
            'uuid' => '974f33e2-700b-43cf-8847-c31896775377'
        ],

        [
            'name' => 'сыр Чеддер',
            'uuid' => '61ab2a08-0070-483c-a8da-23d42007005d'
        ],

        [
            'name' => 'огурцы маринованные',
            'uuid' => '26e8d8da-f18d-47af-ba44-15f2eedcec93'
        ],

        [
            'name' => 'лук',
            'uuid' => '3adda32f-87da-4f3f-8ee7-5597805d8b79'
        ],

        [
            'name' => 'салат айсберг',
            'uuid' => '2f24e079-05d2-4e44-8a2c-0a12f94d67ae'
        ],

        [
            'name' => 'соус горчичный',
            'uuid' => 'f91d6bef-ec0d-4e0e-9863-dd323087f9a9'
        ],

        [
            'name' => 'соус тести грилл',
            'uuid' => 'f3d2b47f-0b28-483f-8314-8c3e0643db2c'
        ],

        [
            'name' => 'говяжья котлета 100г',
            'uuid' => '61dc4779-b419-4f51-ae30-93d656eb0953'
        ],

        [
            'name' => 'ломтики запеченной трески и лосося',
            'uuid' => 'de3a42ff-8af9-49c9-9066-50e608013366'
        ],

        [
            'name' => 'зерновая булочка',
            'uuid' => '36fcc241-e24c-4fad-9766-c7329666c120'
        ],

        [
            'name' => 'свежие огурцы',
            'uuid' => 'a6ec446d-2117-496e-b8bf-f904db9a684a'
        ],

        [
            'name' => 'красный лук',
            'uuid' => '33d15852-2420-43f0-aabb-b5385f58869f'
        ],

        [
            'name' => 'соус сливочно-шпинатный',
            'uuid' => '4a1393b0-fb3d-4510-aec8-f63f94c88f74'
        ],

        [
            'name' => 'куриное филе, обжаренное на гриле',
            'uuid' => '3c228634-cb13-4b1c-aee9-d34049f784a3',
        ],

        [
            'name' => 'хрустящий бекон',
            'uuid' => '3a533e02-6f65-4237-bb40-7c3783802834',
        ],

        [
            'name' => 'соус 1000 островов',
            'uuid' => '79f6002b-6632-49c4-b782-c33472452d25',
        ],

        [
            'name' => 'майонез',
            'uuid' => '74a316ab-3272-4a8d-a717-e4a3a9ff5dc2',
        ],

        [
            'name' => 'жареное яйцо',
            'uuid' => '93ffb6ea-ad7f-4a70-9f91-86dc6f2f0059',
        ],

        [
            'name' => 'коул соул',
            'uuid' => '99cee078-f6ba-486d-83bd-021d905a8bb4',
        ],

        [
            'name' => 'курица',
            'uuid' => 'fa051b44-91f6-4ad1-8d64-7a1b6c408add',
        ],

        [
            'name' => 'сыр Моцарелла',
            'uuid' => '7a0ad02e-c17e-42a6-9b09-89cdc15aa001',
        ],

        [
            'name' => 'сыр Фета',
            'uuid' => '09dc688f-764d-4318-bfcb-893d4d883b9f',
        ],

        [
            'name' => 'соус Томатный',
            'uuid' => '1a1a762f-d23a-4d27-a124-a32634b130fc',
        ],

        [
            'name' => 'ветчина',
            'uuid' => '3dd25565-7cc6-4bfd-8b92-e7085faaa349',
        ],

        [
            'name' => 'грибы',
            'uuid' => 'd8af2ec9-03f3-4343-8989-e31712071473',
        ],

        [
            'name' => 'соус трюфельный',
            'uuid' => '2853f302-25b1-4522-9315-8109fac0eba3',
        ],

        [
            'name' => 'пепперони',
            'uuid' => '04bdcb51-048f-4e27-94d9-ae4fa1a2bad0',
        ],

        [
            'name' => 'соус чесночный оригинальный',
            'uuid' => '3006761a-8137-4f9c-ab5c-fb0cd444bb35',
        ],

        [
            'name' => 'соус Карбонара',
            'uuid' => 'da812c16-c9b0-4021-8b1f-6a05038eb192',
        ],

        [
            'name' => 'сыр Роккфорти',
            'uuid' => 'c72aad9c-e588-4ce7-9482-af743d08f890',
        ],

        [
            'name' => 'сыр Пармезан',
            'uuid' => '56446936-39b1-4960-b8fb-b0de0e7e9498',
        ],

        [
            'name' => 'черный перец',
            'uuid' => '266e867f-fe58-4389-93e3-3b64f690c6a9',
        ],

        [
            'name' => ' сливочное масло',
            'uuid' => '916d75ff-7bb1-466a-94f9-52ebdac68c3d',
        ],

        [
            'name' => ' сыр Пекарино-Романо',
            'uuid' => 'a33dbe1f-ee1f-4aa0-8c04-936f2f652064',
        ],

        [
            'name' => ' домашняя паста',
            'uuid' => 'd0a00b3e-c325-49d6-b3e7-118d5ffac5ae',
        ],

        [
            'name' => ' белое вино',
            'uuid' => '64f9aeb4-ef63-47c0-89e9-da862cde2b6b',
        ],

        [
            'name' => ' сливочно-сырный соус',
            'uuid' => '46a9f15b-2f9b-4584-9676-0ed0f776a604',
        ],

        [
            'name' => ' томаты черри',
            'uuid' => 'fe6ebbc2-faab-41b6-83e3-48a8fb7a9abb',
        ],

        [
            'name' => 'сливки',
            'uuid' => '3948b624-9ec1-4bce-a461-88fd876dda09',
        ],

        [
            'name' => 'соус биск',
            'uuid' => 'bdc4fbff-1621-4907-8185-5c584908e192',
        ],

        [
            'name' => 'лимон',
            'uuid' => 'e9d6ef9d-bf7a-4b8d-8eeb-cceaecca2bf3',
        ],

        [
            'name' => 'замешивается в сырной голове',
            'uuid' => 'abda0f5c-6f8c-40a6-9d9a-37287766241c',
        ],

        [
            'name' => 'баклажан',
            'uuid' => 'b6e5ec02-2101-44fb-911e-8311d43056b2',
        ],

        [
            'name' => 'камамбер',
            'uuid' => 'f4028aa0-f188-47b4-a9fd-9a435d92da81',
        ],

        [
            'name' => 'помидоры розовые',
            'uuid' => '39b5f058-4f70-44a8-80a9-3d2ab13b41a8',
        ],

        [
            'name' => 'соус из коноллли',
            'uuid' => '74204fc7-6427-4cbb-9c09-1213202264d4',
        ],

        [
            'name' => 'соус терияки',
            'uuid' => '53942fad-1a72-4cc8-b3c1-aa180e6da788',
        ],

        [
            'name' => 'кинза',
            'uuid' => '7e0e86f1-b97d-47d2-afee-735ef2712394',
        ],

        [
            'name' => 'микс салатов',
            'uuid' => 'e69cb8d9-5601-4216-8893-2d72a3db9ce2',
        ],

        [
            'name' => 'соус чили сладкий',
            'uuid' => '553a8c40-0885-478a-ab36-63718b57d9f7',
        ],

        [
            'name' => 'говяжья вырезка',
            'uuid' => '824738fb-9219-4ce9-bddd-a12449f61375',
        ],

        [
            'name' => 'каперсы',
            'uuid' => 'eea123e3-b203-4687-9547-84ea2b8e85e1',
        ],

        [
            'name' => 'соус бальзамический',
            'uuid' => '5a788a2f-2efc-4790-a953-bd933f439787',
        ],

        [
            'name' => 'соус азиатский',
            'uuid' => '01d1fa59-49f4-4c81-bd5c-e83bc17cc5fe',
        ],

        [
            'name' => 'соус ТарТар',
            'uuid' => '100283aa-1b44-41f1-af04-c459f0a874aa',
        ],

        [
            'name' => 'Бон багет',
            'uuid' => '809744e9-c6b1-4612-b480-b119cf9eced1',
        ],

        [
            'name' => 'оливкое масло',
            'uuid' => 'ad29a675-20ab-4b3d-8523-bd1e7bd554e4',
        ],

        [
            'name' => 'говяжья вырезка (Миньон)',
            'uuid' => 'e86d874b-5a2e-4a4d-bd9f-82a9855522df',
        ],

        [
            'name' => 'заправка стейк салат',
            'uuid' => '6db01824-c49d-4efd-8342-27c03e8011a6',
        ],

        [
            'name' => 'крем бальзамик',
            'uuid' => 'a5e848ae-8cf7-4f71-87af-dc55c39a9bfd',
        ],

    ];

    public static function up(): void
    {
        foreach (self::INGREDIENTS as $ingredient) {
            Ingredient::create(
                name: $ingredient['name'],
                uuid: $ingredient['uuid']
            );
        }
    }

    public static function down(): void
    {
        foreach (self::INGREDIENTS as $ingredient) {
            Ingredient::deleteByUuid(
                uuid: $ingredient['uuid']
            );
        }
    }

}