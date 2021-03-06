<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
	    'user' => [
		    'identityClass' => 'common\models\User',
		    'enableSession' => false,
//            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
	    ],
	    'response' => [
		    'format' => yii\web\Response::FORMAT_JSON,
		    'charset' => 'UTF-8',
		    'on beforeSend' => function ($event) {
			    header("Access-Control-Allow-Origin: *");
		    }
	    ],
	    'i18n' => [
		    'translations' => [
			    '*' => [
				    'class' => 'yii\i18n\PhpMessageSource',
				    'basePath' => '@app/messages', // if advanced application, set @frontend/messages
				    'sourceLanguage' => 'en',
				    'fileMap' => [
					    //'main' => 'main.php',
				    ],
			    ],
		    ],
	    ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
//	        'scriptUrl'=>'/index.php',
	        'class' => 'yii\web\UrlManager',
	        'enablePrettyUrl' => true,
	        'showScriptName' => false,
	        'rules' => [
		        '/' => 'site/index',
		        '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
	        ],
        ],
    ],
    'modules' => [
	    'api' => [
		    'class' => 'frontend\modules\api\api',
	    ],
    ],
    'params' => $params,
];
