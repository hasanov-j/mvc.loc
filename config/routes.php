<?php

declare(strict_types=1);



use App\Controllers\MainController;
use App\Controllers\NewsController;
use App\Controllers\UploadController;

return [
    //    'news\/(\d+)/comment\/(\d+)' => [
    //        'GET' => [
    //            'action' => 'show',
    //            'controller' => NewsController::class,
    //        ],
    //    ],

    'upload' => [
        'GET' => [
            'action' => 'show',
            'controller' => UploadController::class,
        ],
        'POST' => [
            'action' => 'save',
            'controller' => UploadController::class,
        ],
    ],
    'upload-remove' => [
        'POST' => [
            'action' => 'remove',
            'controller' => UploadController::class,
        ],
        'GET' => [
            'action' => 'showRemoveForm',
            'controller' => UploadController::class,
        ],
    ],
    'news' => [
        'GET' => [
            'action' => 'index',
            'controller' => NewsController::class,
        ],
    ],
    'news\/([0-9]+)' => [
        'GET' => [
            'action' => 'show',
            'controller' => NewsController::class,
        ],
    ],
    '' => [
        'GET' => [
            'action' => 'index',
            'controller' => MainController::class,
        ],
    ],
];
