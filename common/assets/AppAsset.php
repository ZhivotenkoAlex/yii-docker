<?php

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
	/** @var string */
    public $basePath = '@webroot';

	/** @var string */
    public $baseUrl = '@web';

	/** @var string[] */
    public $css = [
        'css/site.css',
    ];

	/** @var array */
    public $js = [
	    'js/app.js'
    ];

	/** @var string[] */
    public $depends = [
    ];
}
