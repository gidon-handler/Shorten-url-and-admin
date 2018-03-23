<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Walla URL shortner',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],

    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'url'
                ],
                [
                    'pattern' => 'url/shorten-url',
                    'route' => 'url/shorten-url',
                ],
                [
                    'pattern' => 're/<short_url:>',
                    'route' => 're/index',
                ],
                [
                    'pattern' => 'admin',
                    'route' => 'admin/index',
                ],
                [
                    'pattern' => 'admin',
                    'route' => 'admin',
                ],
                [
                    'pattern' => 'admin/create',
                    'route' => 'admin/create',
                ],
                [
                    'pattern' => 'admin/view/<id:\d+>',
                    'route' => 'admin/view',
                ],
                [
                    'pattern' => 'admin/delete/<id:\d+>',
                    'route' => 'admin/delete',
                ],
                [
                    'pattern' => 'admin/update/<id:\d+>',
                    'route' => 'admin/update',
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'LETNdCT3BWe1p2kROwmavk91Ttsl764l',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

   // $config['bootstrap'][] = 'gii';
  //  $config['modules']['gii'] = [
  //      'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
  //  ];
}

return $config;
