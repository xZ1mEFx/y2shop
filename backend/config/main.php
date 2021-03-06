<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/admin',
        ],
        'user' => [
            'identityClass' => \backend\models\User::className(),
            'enableAutoLogin' => TRUE,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => TRUE],
            'loginUrl' => ['auth/login'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'rules' => [
                '' => 'site/index',
                '<controller:\w+(-\w+)*>' => '<controller>/index',
                '<controller:\w+(-\w+)*>/<id:\d+>' => '<controller>/view',
                '<controller:\w+(-\w+)*>/<action:\w+(-\w+)*>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+(-\w+)*>/<action:\w+(-\w+)*>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
