<?php

namespace common\components\meta;

use common\components\meta\drivers\BaseDriver;
use common\components\meta\drivers\DriverInterface;
use common\models\Brochure;
use common\models\Category;
use yii\base\InvalidConfigException;

class Meta extends \yii\base\Component
{
	/** @var string */
	public const PAGE_HOME = 'home';

	/** @var string */
	public const PAGE_CATEGORY = 'category';

	/** @var string */
	public const PAGE_BROCHURE = 'brochure';

	/** @var array */
	public $config;

	/** @var array|BaseDriver[]|DriverInterface[] */
	public $drivers = [];

	/**
	 * @return void
	 * @throws InvalidConfigException
	 */
	public function init()
	{
		if (!$this->config) {
			throw new InvalidConfigException('Missing required component parameter "config".');
		}

		foreach ($this->drivers as $page => $class) {
			$this->drivers[$page] = \Yii::createObject([
				'class' => $class,
				'page' => $page,
				'config' => $this->config[$page]
			]);
		}
	}

	/**
	 * @param $page
	 * @param Category|null $category
	 * @param Brochure|null $brochure
	 *
	 * @return void
	 */
	public function registerMetaData($page, $category = null,  $brochure = null): void
	{
		$driver = $this->drivers[$page];

		switch ($page):
			case self::PAGE_CATEGORY:
				$driver->category = $category;
				break;
			case self::PAGE_BROCHURE:
				$driver->category = $category;
				$driver->brochure = $brochure;
				break;
		endswitch;

		$driver->init();

		$driver->register();
	}
}