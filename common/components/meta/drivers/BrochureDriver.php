<?php

namespace common\components\meta\drivers;

use common\models\Brochure;
use common\models\Category;

/**
 * @property Category $category
 * @property Brochure $brochure
 */
class BrochureDriver extends BaseDriver
{
	/**
	 * @return void
	 * @throws \yii\base\InvalidConfigException
	 */
	public function init()
	{
		parent::init();

		if (!$this->category instanceof Category || !$this->brochure instanceof Brochure) {
			return;
		}

		$this->config['title'] = strtr($this->config['title'], [
			'{category_name}' => mb_convert_case($this->category->name, MB_CASE_TITLE),
			'{brochure_date_from}' => \Yii::$app->formatter->asDate($this->brochure->start_date, 'short'),
			'{brochure_date_to}' => \Yii::$app->formatter->asDate($this->brochure->end_date, 'short')
		]);

		$this->config['description'] = strtr($this->config['description'], [
			'{category_name}' => mb_convert_case($this->category->name, MB_CASE_TITLE),
			'{brochure_date_from}' => \Yii::$app->formatter->asDate($this->brochure->start_date, 'short'),
			'{brochure_date_to}' => \Yii::$app->formatter->asDate($this->brochure->end_date, 'short')
		]);

		$this->config['keywords'] = strtr($this->config['keywords'], [
			'{category_name}' => mb_convert_case($this->category->name, MB_CASE_TITLE),
			'{brochure_date_from}' => \Yii::$app->formatter->asDate($this->brochure->start_date, 'short'),
			'{brochure_date_to}' => \Yii::$app->formatter->asDate($this->brochure->end_date, 'short')
		]);
	}
}