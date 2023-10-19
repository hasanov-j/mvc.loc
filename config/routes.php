<?php

declare(strict_types=1);

use App\Controllers\Frontent\Api\FeedbackApiController;
use App\Controllers\Frontent\Api\ProductApiController;
use App\Controllers\Frontent\Api\PromocodeApiController;
use App\Controllers\Frontent\Api\SearchApiController;
use App\Controllers\Frontent\Web\AboutController;
use App\Controllers\Frontent\Web\AuthController;
use App\Controllers\Frontent\Web\FeedbackController;
use App\Controllers\Frontent\Web\MainController;
use App\Controllers\Frontent\Web\OrderController;
use App\Controllers\Frontent\Web\ProductController;
use App\Controllers\Frontent\Web\RegistrationController;
use App\Controllers\Frontent\Web\SearchController;
use App\Controllers\Frontent\Web\ShoppingCartController;

return [

    'about' => [
        'GET' => [
            'action' => 'index',
            'controller' => AboutController::class,
        ],
        'POST' => [
            'action' => 'readMore',
            'controller' => AboutController::class,
        ],
    ],

    '' => [
        'GET' => [
            'action' => 'index',
            'controller' => MainController::class,
        ],
        'POST' => [
            'action' => 'action_name',
            'controller' => 'controller_name',
        ],
    ],


    'feedbacks' => [
        'GET' => [
            'action' => 'index',
            'controller' => FeedbackController::class,
        ],
    ],

    'api\/feedbacks' => [
        'GET' => [
            'action' => 'index',
            'controller' => FeedbackApiController::class,
        ],
        'POST' => [
            'action' => 'store',
            'controller' => FeedbackApiController::class,
        ],
    ],

    'products' => [
        'GET' => [
            'action' => 'index',
            'controller' => ProductController::class,
        ],
    ],

    'api\/products.*' => [
        'GET' => [
            'action' => 'index',
            'controller' => ProductApiController::class,
        ],
    ],

    'reg' => [
        'GET' => [
            'action' => 'index',
            'controller' => RegistrationController::class,
        ],

        'POST' => [
            'action' => 'store',
            'controller' => RegistrationController::class,
        ],
    ],

    'login' => [

        'GET' => [
            'action' => 'index',
            'controller' => AuthController::class,
        ],

        'POST' => [
            'action' => 'login',
            'controller' => AuthController::class,
        ],

    ],

    'logout' => [
        'GET' => [
            'action' => 'logout',
            'controller' => AuthController::class,
        ],
    ],

    'search'=> [
        'GET'=>[
            'action' => 'index',
            'controller' => SearchController::class,
        ],
    ],

    'api\/search.*'=> [
        'GET'=>[
            'action' => 'index',
            'controller' => SearchApiController::class,
        ],
    ],

    'shopping-cart'=> [
        'GET'=>[
            'action' => 'index',
            'controller' => ShoppingCartController::class,
        ],
    ],

    'api\/shopping-cart'=> [
        'GET'=>[
            'action' => 'index',
            'controller' => ShoppingCartController::class,
        ],
    ],

    'api\/promocodes'=> [
        'POST'=>[
            'action' => 'store',
            'controller' => PromocodeApiController::class,
        ],
    ],

    'orders'=> [
        'POST'=>[
            'action' => 'store',
            'controller' => OrderController::class,
        ],
    ],

];
