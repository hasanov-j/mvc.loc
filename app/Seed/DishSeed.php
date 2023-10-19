<?php

namespace App\Seed;

use App\Models\Dish;

class DishSeed implements SeedInterface
{
    const DISHES=[
        [
            'id_categories'=>1,
            'name'=>'Джорджия с говядиной',
            'cost'=>360,
            'url'=> '/public/images/georgia_chicken.jpg',
            'uuid'=>'dea0a7d1-bec7-45b3-a896-f653deb5e84a',
            'search_synonyms'=>'["burger","бургер","гамбургер","мясной бургер","говядина","джордия"]',
        ],

        [
            'id_categories'=>1,
            'name'=>"О'Нил",
            'cost'=>610,
            'url'=>'/public/images/oneel.jpg',
            'uuid'=>'48c5ed6b-2c14-42bd-9422-35f80ee3177e',
            'search_synonyms'=>'["burger","бургер","гамбургер","мясной бургер","онил"]',
        ],

        [
            'id_categories'=>1,
            'name'=>"Бести",
            'cost'=>280,
            'url'=>'/public/images/besty.jpg',
            'uuid'=>'b171301d-724d-4202-aaba-e44f6a7e1fdb',
            'search_synonyms'=>'["burger","бургер","гамбургер","мясной бургер","бести"]',
        ],

        [
            'id_categories'=>1,
            'name'=>"Fish Burger",
            'cost'=>390,
            'url'=>'/public/images/fish_burger.jpg',
            'uuid'=>'d4b3da1b-e1cf-4073-adac-bf2202532f98',
            'search_synonyms'=>'["burger","бургер","гамбургер","мясной бургер","фиш","fish"]',
        ],

        [
            'id_categories'=>1,
            'name'=>"Клаб Бургер",
            'cost'=>330,
            'url'=>'/public/images/club_burger.jpg',
            'uuid'=>'5a8a51e1-550a-4d43-a36a-20c26e1a80b8',
            'search_synonyms'=>'["burger","бургер","гамбургер","мясной бургер","клаб"]',
        ],

        [
            'id_categories'=>1,
            'name'=>"Ронни",
            'cost'=>430,
            'url'=> '/public/images/ronny.jpg',
            'uuid'=>'f0df322a-83b8-4c0f-af15-99d230852c7b',
            'search_synonyms'=>'["burger","бургер","гамбургер","мясной бургер","ронни"]',
        ],

        [
            'id_categories'=>2,
            'name'=>"Чикен Песто",
            'cost'=>499,
            'url'=>'/public/images/chicken_pesto.png',
            'uuid'=>'5eba68de-f707-4361-9aa0-6ab20b7516e4',
            'search_synonyms'=>'["pizza","пицца","сыр","cheese","чикен песто"]',
        ],

        [
            'id_categories'=>2,
            'name'=>"Трюфельная Делюкс",
            'cost'=>499,
            'url'=>'/public/images/trufel_pizza.png',
            'uuid'=>'b922777d-37a2-42e7-bb44-9bee69ccbff9',
            'search_synonyms'=>'["pizza","пицца","трюфель","сыр","cheese","делюкс"]',
        ],

        [
            'id_categories'=>2,
            'name'=>"Пепперони Ранч",
            'cost'=>429,
            'url'=>'/public/images/pepperony_runch.png',
            'uuid'=>'0b192e7e-5ba6-4a97-b158-f01166a6a9a8',
            'search_synonyms'=>'["pizza","пицца","сыр","cheese","пепперони"]',
        ],

        [
            'id_categories'=>2,
            'name'=>"Пепперони",
            'cost'=>429,
            'url'=>'/public/images/pepperony.png',
            'uuid'=>'53c3ccdc-b3be-404c-9b4c-c2036edea604',
            'search_synonyms'=>'["pizza","пицца","сыр","cheese","пепперони"]',
        ],

        [
            'id_categories'=>2,
            'name'=>"4 Сыра",
            'cost'=>639,
            'url'=>'/public/images/four_cheers.png',
            'uuid'=>'b5cbf06d-bcdf-41e6-93a7-4ff52803f08e',
            'search_synonyms'=>'["pizza","пицца","сыр","cheese","4 сыра"]',
        ],

        [
            'id_categories'=>2,
            'name'=>"Маргарита",
            'cost'=>289,
            'url'=>'/public/images/margarita.png',
            'uuid'=>'47632db3-2ef7-4191-894d-ea819f7be535',
            'search_synonyms'=>'["pizza","пицца","сыр","cheese","маргарита"]',
        ],

        [
            'id_categories'=>2,
            'name'=>"Микс BBQ",
            'cost'=> 569,
            'url'=> '/public/images/mix_bbq.png',
            'uuid'=>'ffc2e672-d17c-4cc4-b44c-69ce4a209e35',
            'search_synonyms'=>'["pizza","пицца","сыр","cheese","bbq","микс"]',
        ],

        [
            'id_categories'=> 3,
            'name'=>"Паста Карбонара",
            'cost'=> 499,
            'url'=> '/public/images/karbonara.jpg',
            'uuid'=>'d4ce2254-55eb-4305-bccf-d821e3d66bfa',
            'search_synonyms'=>'["pasta","паста","сыр","cheese","макароны","карбонара"]',
        ],

        [
            'id_categories'=>3,
            'name'=>"Букатини Качо Пепе",
            'cost'=>690,
            'url'=> '/public/images/kacho_pepe.jpg',
            'uuid'=>'a39e7fe6-3b83-4b3d-99b4-ca658113166d',
            'search_synonyms'=>'["pasta","паста","сыр","cheese","макароны","букатини"]',
        ],

        [
            'id_categories'=>3,
            'name'=>"Черные Лингвини с крабом и соусом Биск",
            'cost'=>1250,
            'url'=> '/public/images/black_linguiny.jpg',
            'uuid'=>'e739df0e-f1a4-4e30-85ab-e9c311ecd1ed',
            'search_synonyms'=>'["pasta","паста","сыр","cheese","макароны","краб"]',
        ],

        [
            'id_categories'=>3,
            'name'=>"Домашняя Паста с черным Трюфелем",
            'cost'=>1500,
            'url'=> '/public/images/pasta_trufel.jpg',
            'uuid'=>'ea057c97-ccd6-4a8e-8cb9-288dcae334c8',
            'search_synonyms'=>'["pasta","паста","сыр","cheese","макароны","трюфель"]',
        ],

        [
            'id_categories'=>4,
            'name'=>"Баклажан с сыром Камамбером",
            'cost'=>300,
            'url'=>'/public/images/baklajan_with_camamber.jpg',
            'uuid'=>'2b6dc1a3-d6e1-49bc-ab22-45e96119a10f',
            'search_synonyms'=>'["салат","salad","бакладжан","камамбер"]',
        ],

        [
            'id_categories'=>4,
            'name'=>"Баклажаны в панировке",
            'cost'=>300,
            'url'=>'/public/images/baklajan.jpg',
            'uuid'=>'fc447b1e-e44f-4589-ba5f-2dc6c0d703e0',
            'search_synonyms'=>'["салат","salad","панировка"]',
        ],

        [
            'id_categories'=>4,
            'name'=>"Карпаччо",
            'cost'=>300,
            'url'=>'/public/images/karpacho.jpg',
            'uuid'=>'2d2c4e51-6ae3-4212-95c4-8a41dafe9942',
            'search_synonyms'=>'["Салат","Salad"]',
        ],

        [
            'id_categories'=>4,
            'name'=>"ТарТар",
            'cost'=>300,
            'url'=>'/public/images/tartar.jpg',
            'uuid'=>'eda12c17-c91c-4220-bcad-4c2634ebb670',
            'search_synonyms'=>'["салат","salad", "сырое мясо"]',
        ],

        [
            'id_categories'=>4,
            'name'=>"Стейк салат",
            'cost'=>300,
            'url'=>'/public/images/steyk_salat.jpg',
            'uuid'=>'69e17930-fd1c-4908-9b5e-8f31794f0a32',
            'search_synonyms'=>'["салат","salad","стейк"]',
        ],

        [
            'id_categories'=>5,
            'name'=>"Rich Bitter",
            'cost'=>190,
            'url'=>'/public/images/rich_bitter.jpg',
            'uuid'=>'a2631bcf-d52b-4a5f-a8d7-777c6005e634',
            'search_synonyms'=>'["напитки","холодное","сладкое","прохлаждающий сок","соки","rich"]',
        ],

        [
            'id_categories'=>5,
            'name'=>"Rich Cola",
            'cost'=>190,
            'url'=>'/public/images/rich_cola.jpg',
            'uuid'=>'32d82afb-c6fa-4a3a-8049-987714598d2d',
            'search_synonyms'=>'["напитки","холодное","сладкое","прохлаждающий сок","соки","cola","rich"]',
        ],

        [
            'id_categories'=>5,
            'name'=>"Лимонад Еживика",
            'cost'=>180,
            'url'=>'/public/images/limonad_yezivika.jpg',
            'uuid'=>'d4d26e0b-f38f-4410-bddb-7208f0e53d2f',
            'search_synonyms'=>'["напитки","холодное","сладкое","прохлаждающий сок","соки","лимонад","еживика"]',
        ],

        [
            'id_categories'=>5,
            'name'=>"Лимонад Оранж",
            'cost'=>180,
            'url'=>'/public/images/limonad_orange.jpg',
            'uuid'=>'f94a11af-8646-4997-897f-594812432d9d',
            'search_synonyms'=>'["напитки","холодное","сладкое","прохлаждающий сок","соки","лимонад"]',
        ],

        [
            'id_categories'=>5,
            'name'=>"Лимонад Голубика Кокос",
            'cost'=>180,
            'url'=>'/public/images/limonad_golubika.jpg',
            'uuid'=>'9a7293f7-3b44-427b-8885-d3a36336cbba',
            'search_synonyms'=>'["напитки","холодное","сладкое","прохлаждающий сок","соки"]',
        ],

        [
            'id_categories'=>5,
            'name'=>"Лимонад Классика",
            'cost'=>180,
            'url'=>'/public/images/limonad_classic.jpg',
            'uuid'=>'254067d0-1004-4f53-b0fe-9c977bd36500',
            'search_synonyms'=>'["напитки","холодное","сладкое","прохлаждающий сок","соки"]',
        ],

        [
            'id_categories'=>5,
            'name'=>"Морс Ягоды",
            'cost'=>180,
            'url'=>'/public/images/mors_yagoda.jpg',
            'uuid'=>'5dc2d16d-51f2-43d5-acf0-604815932aba',
            'search_synonyms'=>'["напитки","холодное","сладкое","прохлаждающий сок","соки","rich"]',
        ],

        [
            'id_categories'=>5,
            'name'=>"Сок Rich Вишня",
            'cost'=>190,
            'url'=>'/public/images/rich_cherry.jpg',
            'uuid'=>'5710e7a6-b2bb-487d-b2d8-bc738cf28824',
            'search_synonyms'=>'["напитки","холодное","сладкое","прохлаждающий сок","соки","rich"]',
        ],

        [
            'id_categories'=>5,
            'name'=>"Сок Rich Яблоко",
            'cost'=>190,
            'url'=>'/public/images/rich_apple.jpg',
            'uuid'=>'317b6e48-1cb5-4933-a1d5-aacf59c85393',
            'search_synonyms'=>'["напитки","холодное","сладкое","прохлаждающий сок","соки","rich"]',
        ],

        [
            'id_categories'=>5,
            'name'=>"Сок Rich Апельсин",
            'cost'=>190,
            'url'=>'/public/images/rich_orange.jpg',
            'uuid'=>'13ecf83b-4426-468b-a0f1-f19f2863b555',
            'search_synonyms'=>'["напитки","холодное","сладкое","прохлаждающий сок","соки","апельсин","rich"]',
        ],

    ];

    public static function up(): void
    {

        foreach (self::DISHES as $dish){
            Dish::create(
                id_categories: $dish['id_categories'],
                name: $dish['name'],
                cost: $dish['cost'],
                url: $dish['url'],
                searchSynonyms: $dish['search_synonyms'],
                uuid: $dish['uuid'],
            );
        }

    }
    public static function down(): void
    {
        foreach (self::DISHES as $dish){
            Dish::deleteByUuid(uuid: $dish['uuid']);
        }
    }
}