<?php

// use Dotenv\Dotenv;
// $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
// $dotenv->load();
$db = require __DIR__ . '/firebaseDb.php';
$variables = ['GDB_PASS', 'DB_NAME', 'DB_HOST', 'GDB_USER', 'DB_PORT'];
$values = [];

foreach ($variables as $v) {
	$values[$v] = getenv($v);
}

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'bootstrap' => ['log', 'debug', 'gii'],
	'language' => 'pl-PL',
    'components' => [
	    'formatter' => [
		    'locale' => 'pl_PL'
	    ],
        'cache' => [
            'class' => \yii\caching\DummyCache::class,
        ],
	    'user' => [
		    'identityClass' => 'common\models\User',
		    'enableAutoLogin' => true,
		    'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
	    ],
	    'session' => [
		    // this is the name of the session cookie used for login on the frontend
		    'name' => 'advanced-frontend',
	    ],
	    'request' => [
		    'csrfParam' => '_csrf-frontend',
		    'cookieValidationKey' => 'qyblSvBzn8tz6vUhUbwWClRIEoVyyOKR',
	    ],
	    'log' => [
		    'traceLevel' => YII_DEBUG ? 3 : 0,
		    'targets' => [
			    [
				    'class' => \yii\log\FileTarget::class,
				    'levels' => ['error', 'warning'],
			    ],
		    ],
	    ],
	    'db' => [
			'class' => \yii\db\Connection::class,
			'dsn' => 'mysql:host=host.docker.internal;dbname=yii2advanced',
			// 'dsn' => 'mysql:host=127.0.0.1;dbname=yii2advanced',
			'username' => 'root',
		    'password' => '',
		    'charset' => 'utf8',
		    'enableSchemaCache' => true,
	    ],
	    'view' => [
			'class' => \common\components\View::class,
		    'theme' => [
			    'pathMap' => [
				    '@iulotka/views'=>'@common/views',
				    '@gazetki/views'=>'@common/views',
			    ],
		    ],
	    ],
        'errorHandler' => [
			'errorAction' => 'site/error',
		]
    ],
	'modules' => [
		'debug' => [
			'class' => 'yii\debug\Module',
			'allowedIPs' => ['127.0.0.1', 'localhost', '::1'],
		],
		'gii' => [
			'class' => 'yii\gii\Module',
			'allowedIPs' => ['127.0.0.1', 'localhost', '::1'],
		]
	]
];
