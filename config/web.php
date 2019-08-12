<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'oliya',
    'name' => 'Oliya.ml',
    'language' => 'uk-UA',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'cart' => [
            'class' => 'app\components\CartComponent',
        ],
        'request' => [
            'cookieValidationKey' => 'YLc3xLz4NNMusUre3YzFFRDhT_Qmw3FE',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'mailer' => YII_ENV_DEV ?
        [
        'class' => 'yii\swiftmailer\Mailer',

        'useFileTransport' => false,
            ] : 
        require(__DIR__ . '/smtp.php'),
        
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => YII_ENV_DEV ? require(__DIR__ . '/db_dev.php') : require(__DIR__ . '/db_prod.php'),
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/index',
                '404' => 'site/error',
                'cart' => 'site/cart',
                'oil/<id:\d+>' => 'site/view',
            ],
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            'linkAssets' => YII_ENV_DEV ? false : true,
        ],
        
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
