<?php

namespace common\components\meta\drivers;

use common\models\Brochure;
use common\models\Category;
use yii\base\InvalidConfigException;

abstract class BaseDriver extends \yii\base\BaseObject implements DriverInterface
{
	/** @var array */
	public $config;

	/** @var string */
	public $page;

	/** @var Category|null */
	public $category;

	/** @var Brochure|null */
	public $brochure;

	/**
	 * @return void
	 * @throws InvalidConfigException
	 */
	public function init()
	{
		if (!$this->config) {
			throw new InvalidConfigException('Missing required driver parameter "config".');
		}

		if (!$this->page) {
			throw new InvalidConfigException('Missing required driver parameter "page".');
		}
	}

	/**
	 * @return void
	 */
	public function register(): void
	{
		$this->registerTitle();

		$this->registerOgTitle();

		$this->registerDescription();

		$this->registerKeywords();
	}

	/**
	 * @return void
	 */
	public function registerTitle(): void
	{
		\Yii::$app->view->title = $this->config['title'];
	}

	/**
	 * @return void
	 */
	public function registerOgTitle(): void
	{
		\Yii::$app->view->registerMetaTag(['name' => 'og:title', 'content' => $this->config['og:title']]);
	}

	/**
	 * @return void
	 */
	public function registerDescription(): void
	{
		\Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $this->config['description']]);
	}

	/**
	 * @return void
	 */
	public function registerKeywords(): void
	{
		\Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $this->config['keywords']]);
	}
}