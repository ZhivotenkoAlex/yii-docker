<?php

namespace common\controllers;

class WebController extends \yii\web\Controller
{
	/**
	 * {@inheritdoc}
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			]
		];
	}
}