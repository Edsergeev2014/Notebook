<?php

use app\behaviors\LogBehavior;

$params = require __DIR__ . '/params.php';
// $db = require __DIR__ . '/db.php';
$db = file_exists(__DIR__ . '/db_local.php')?
    (require __DIR__ . '/db_local.php'):
    (require __DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        // '@files' => '/var/www/files/',
        '@files' => '/notebook/web/files/',
        // /Applications/MAMP/htdocs/notebook/web/files/
        '@filesWeb'=>'/files/',
    ],
    'as logs' => ['class' => \app\behaviors\LogBehavior::class],
    'language'=>'ru_RU',
    'components' => [
        'activity'=>['class'=>\app\components\ActivityComponent::class],
        'day'=>['class'=>\app\components\DayComponents::class],
        'fileSaver'=>['class'=>\app\components\FileSaverComponents::class],
        //'lastPage'=>['class'=>\app\components\LastPageComponent::class],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'fdrF4OIcoamwId9TRZ165h7epmxowmj-',
            'parsers' => [
                'application/json' => \yii\web\JsonParser::class
            ],
            'as logs' => ['class' => \app\behaviors\LogBehavior::class]
        ],
        'rbac'=>['class'=>\app\components\RbacComponent::class],
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
        'auth' => ['class'=>\app\components\AuthComponent::class],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
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
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'create'=>'activity/create',
                'new'=>'activity/create',
                // Url -  http://localhost:8888/notebook/web/event/view2/6
                'GET event/view2/<id:\d+>'=>'activity/view2',
                // Регулярное выражение с буквами - используем w
                // 'event/view2/<id:\w+>'=>'activity/view2',
                'event/<action>'=>'activity/<action>',
                [
                    'class'=>yii\rest\UrlRule::class,
                    'controller'=>'activity-rest',
                    'pluralize'=>false
                    ]
            ],
        ],
        
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['*'],
    ];
}

return $config;
