<?php

declare(strict_types=1);

use App\Controllers\FeedbackController;
use App\Controllers\SliderController;

return [

    'sliders/([a-z0-9\-]+)'=>[
        'DELETE'=>[
            'action' => 'destroy',
            'controller' => SliderController::class,
        ],
    ],

    'sliders' => [

        'GET' => [
            'action' => 'index',
            'controller' => SliderController::class,
        ],

        'POST' => [
            'action' => 'store',
            'controller' => SliderController::class,
        ],
    ],

    'feedback' => [

        'GET' => [
            'action' => 'index',
            'controller' => FeedbackController::class,
        ],

        'POST' => [
            'action' => 'store',
            'controller' => FeedbackController::class,
        ],

    ],

];
