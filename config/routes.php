<?php

declare(strict_types=1);

return [

    'test1' => [
        'GET' => [
            'action' => 'action_name',
            'controller' => "controller_name",
        ],
        'POST' => [
            'action' => 'action_name',
            'controller' => "controller_name",
        ],
    ],

    'test2' => [
        'POST' => [
            'action' => 'action_name',
            'controller' => 'controller_name',
        ],
        'GET' => [
            'action' => 'action_name',
            'controller' => 'controller_name',
        ],
    ],

];
