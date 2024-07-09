<?php

namespace common\classes\AutoBind;

use common\classes\Optional\Optional;
use yii\base\InlineAction;
use yii\db\ActiveRecordInterface;
use yii\web\NotFoundHttpException;

/**
 * Trait BindActionParamsTrait
 * @package app\controllers\Controller
 */
trait BindActionParamsTrait
{
    /**
     * @param $action
     * @param $params
     * @return array
     * @throws NotFoundHttpException
     * @throws \ReflectionException
     * @throws \yii\web\BadRequestHttpException
     */
    public function bindActionParams($action, $params)
    {
        $args = parent::bindActionParams($action, $params);

        if (!$action instanceof InlineAction) {
            return $args;
        }

        $method = new \ReflectionMethod($this, $action->actionMethod);

	    foreach ($method->getParameters() as $index => $param) {

		    $value = \Yii::$app->request->get($param->getName());

            $type = $param->getType();
            if ($type === null) {
                continue;
            }

			$class = $param->getType()->getName();

		    if ($value && ($model = \Yii::createObject($class)) !== null && $model instanceof ActiveRecordInterface) {

			    $model = $model::findOne(['urlname' => $value]);

			    if ($model instanceof Optional) {
				    $model = $model->orNull();
			    }

			    if (!$model) {
				    throw new NotFoundHttpException('Model with ' . $param->getName() . ' ' . strip_tags($value) . ' not found.');
			    }

			    $args[$index] = $model;
		    }
	    }

        return $args;
    }
}