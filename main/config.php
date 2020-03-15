<?php

return [
    'name' => 'Мой магазин',
    'defaultController' => 'good',

    'components' => [
        'db' => [
            'class' => \App\services\DB::class,
            'config' => [
                'driver' => 'mysql',
                'host' => 'localhost',
                'port' => '8889',
                'dbname' => 'gbphp',
                'charset' => 'UTF8',
                'username' => 'root',
                'password' => 'xq4q5r',
            ]
        ],
        'renderer' => [
          'class' => \App\services\renders\TwigRenderer::class
        ],
        'goodRepository' => [
          'class' => \App\repositories\GoodRepository::class
        ],
        'request' => [
            'class' => \App\services\Request::class
        ],
        'cartService' => [
            'class' => \App\services\CartService::class
        ]
    ]
];