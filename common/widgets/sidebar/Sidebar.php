<?php

namespace common\widgets\sidebar;

use common\services\CategoryService;
use yii\base\InvalidConfigException;

class Sidebar extends \yii\base\Widget
{
	/** @var int */
	private const CACHE_LIFETIME = 300;

	/** @var string */
	private $cacheId;

    /** @var bool */
    public $is_amp = false;

	/** @var CategoryService */
	private $categoryService;

	/**
	 * @param $config
	 * @param CategoryService $categoryService
	 */
	public function __construct(CategoryService $categoryService, $config = [])
	{
		parent::__construct($config);
		$this->categoryService = $categoryService;
	}

	/**
	 * @return void
	 */
	public function init()
	{
		parent::init();
		$this->cacheId = \Yii::$app->cache->buildKey([__CLASS__, \Yii::$app->request->getAbsoluteUrl(), (int) $this->is_amp]);
	}

	/**
	 * @return mixed|string
	 */
	public function run()
	{
		return \Yii::$app->cache->getOrSet($this->cacheId, function () {
            $view_file = 'index' . ($this->is_amp ? '_amp' : '');

			return $this->render($view_file, [
				'models' => $this->categoryService->getAllForSidebar()
			]);
		}, self::CACHE_LIFETIME);
	}
}