<?php
use \yii\web\Request;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$baseUrl = str_replace('/web', '', (new Request)->getBaseUrl());

$config = [
    'id' => '#iRFOp#qq!#cHfjXz2WnqdZfM&5dp52avK!6L&@UEEMCXuHf@x',
    'basePath' => dirname(__DIR__),

    'language' => 'pt-BR',
    'timezone' => 'America/Manaus',
    'charset'=>'utf-8',

    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [

        // CUSTOM PARAMS ----------------------------------
        'ButtonDefault' => [
            'class' => 'app\components\ButtonDefault'
        ],
        'ConvertToBase64' => [
            'class' => 'app\components\ConvertToBase64'
        ],
        'RequestPath' => [
            'class' => 'app\components\RequestPath'
        ],
        'Utils' => [
            'class' => 'app\components\Utils'
        ],
        'Messages' => [
            'class' => 'app\components\Messages'
        ],
        // CUSTOM PARAMS ----------------------------------

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'wGZ!IvZ*LLJwP44amB0V2triYgvCfZ5&tQJpSLzkjuNOg6AAnU',
            'baseUrl' => $baseUrl,
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
        // URL PRETTY
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ],
        ],
    ],

    // force login ------------------------------------------------
    'as beforeRequest' => [
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            [
                'allow' => true,
                'actions' => ['login', 'cadastrar'],
            ],
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
        'denyCallback' => function () {
            return Yii::$app->response->redirect(['site/login']);
        },
    ],
    // force login ------------------------------------------------

    'params' => $params,
];

if (ENVIRONMENT == 'dev') {
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
        'allowedIPs' => ['*'],
    ];
}

return $config;
