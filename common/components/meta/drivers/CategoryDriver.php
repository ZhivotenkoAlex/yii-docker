<?php

namespace common\components\meta\drivers;

use common\models\Category;

/**
 * @property Category $category
 */
class CategoryDriver extends BaseDriver
{
	/**
	 * @return void
	 * @throws \yii\base\InvalidConfigException
	 */
	public function init()
	{
		parent::init();

		if (!$this->category instanceof Category) {
			return;
		}

		$this->config['title'] = strtr($this->config['title'], [
			'{category_name}' => mb_convert_case($this->category->name, MB_CASE_TITLE)
		]);

		$this->config['description'] = strtr($this->config['description'], [
			'{category_name}' => mb_convert_case($this->category->name, MB_CASE_TITLE)
		]);

		$this->config['keywords'] = strtr($this->config['keywords'], [
			'{category_name}' => mb_convert_case($this->category->name, MB_CASE_TITLE)
		]);
	}
}