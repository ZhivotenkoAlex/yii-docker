<?php

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/params.php'
);

return [
    'id' => 'app-gazetki',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'gazetki\controllers',
    'components' => [
		'cache' => [
			'class' => \yii\caching\FileCache::class,
			'cachePath' => '@runtime/cache'
		],
	    'meta' => [
			'class' => \common\components\meta\Meta::class,
		    'config' => $params['meta'],
		    'drivers' => [
			    \common\components\meta\Meta::PAGE_HOME => \common\components\meta\drivers\HomeDriver::class,
			    \common\components\meta\Meta::PAGE_CATEGORY => \common\components\meta\drivers\CategoryDriver::class,
			    \common\components\meta\Meta::PAGE_BROCHURE => \common\components\meta\drivers\BrochureDriver::class
		    ]
	    ],
	    'urlBuilder' => [
			'class' => \gazetki\components\Url::class
	    ],
        'urlManager' => [
	        'enablePrettyUrl' => true,
	        'showScriptName' => false,
	        'rules' => [
				'promocje/<category:[\w\_\-\.]+>' => 'site/category',
		        'amp/promocje/<category:[\w\_\-\.]+>' => 'amp/category',
				'gazetka/<category:[\w\_\-\.]+>/ulotka_<brochure:[\w\_\-\.\,\/\|]+>_od_<from:(\d{4})\-(\d{2})\-(\d{2})>_do_<to:(\d{4})\-(\d{2})\-(\d{2})>' => 'site/brochure',
		        'amp/gazetka/<category:[\w\_\-\.]+>/ulotka_<brochure:[\w\_\-\.\,\/\|]+>_od_<from:(\d{4})\-(\d{2})\-(\d{2})>_do_<to:(\d{4})\-(\d{2})\-(\d{2})>' => 'amp/brochure',
		        'sitemap.xml' => 'site/sitemap',
		        'sitemap-<category:[\w\_\-\.]+>.xml' => 'site/sitemap',
		        'amp' => 'amp/index',
		        'amp/search' => 'amp/search',
		        '/' => 'site/index',
		        'search' => 'site/search',
	        ]
        ],
    ],
    'params' => $params,
];
