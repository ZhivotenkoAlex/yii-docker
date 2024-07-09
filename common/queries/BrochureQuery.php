<?php

namespace common\queries;

class BrochureQuery extends \yii\db\ActiveQuery
{
	/**
	 * @return void
	 */
	public function init()
	{
		parent::init();

		$this->andWhere([
			'is_removed' => 0
		])->andWhere([
			'>=', 'start_date', (new \DateTimeImmutable('2022-09-23'))->format('Y-m-d')
		]);
	}

	/**
	 * {@inheritdoc}
	 * @return \common\models\Brochure[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return \common\models\Brochure|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}