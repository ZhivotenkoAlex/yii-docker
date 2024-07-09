<?php

namespace common\controllers;

use common\models\Brochure;
use common\services\BrochureService;
use common\services\LeafletService;

class ApiController extends \yii\rest\Controller
{
	/** @var LeafletService */
	private $leafletService;

	/** @var BrochureService */
	private $brochureService;

	/**
	 * @param $id
	 * @param $module
	 * @param LeafletService $leafletService
	 * @param $config
	 */
	public function __construct($id, $module, LeafletService $leafletService, BrochureService $brochureService, $config = [])
	{
		parent::__construct($id, $module, $config);
		$this->leafletService = $leafletService;
		$this->brochureService = $brochureService;
	}

	/**
	 * @param $action
	 *
	 * @return bool
	 * @throws \yii\web\BadRequestHttpException
	 */
	public function beforeAction($action)
	{
		\Yii::$app->response->format = \Yii::$app->response::FORMAT_JSON;
		return parent::beforeAction($action);
	}

	/**
	 * @param $store
	 * @param $leaflet
	 * @param $old
	 *
	 * @return \yii\web\Response
	 */
	public function actionLeaflets($store = null, $leaflet = null, $old = 0)
	{
		$result = [];

		try {
			$leafletsArray = $this->leafletService->processLeafletsArray($old);
		} catch (\Throwable $exception) {
			return $this->asJson([
				'status' => $exception->getCode() ?? 500,
				'message' => $exception->getMessage()
			]);
		}

		if ($store && $leaflet) {
			if (isset($leafletsArray[$store]) && isset($leafletsArray[$store]["images"][$leaflet])) {
				$result = $leafletsArray[$store]["images"][$leaflet];
				$result["storename"] = $leafletsArray[$store]["name"];
			}
		} else if ($store) {
			if (isset($leafletsArray[$store])) {
				$result = $leafletsArray[$store];
			}
		} else {
			$result = $leafletsArray;
		}

		exit(json_encode([
			'status' => empty($result) ? 201 : 200,
			'objects' => $result
		]));
	}

	/**
	 * @return array
	 */
	public function actionDisableBrokenLeaflets()
	{
		$results = [];

		foreach (Brochure::findAll(['is_removed' => 0]) as $brochure) {
			try {
				$fileExists = $this->brochureService->remoteFileExists($brochure->image);
			} catch (\Throwable $exception) {
				$results[] = $exception->getMessage() . PHP_EOL;
				continue;
			}

			if ($fileExists) {
				$results[] = sprintf('File %s exists. Brochure %s is OK.', $brochure->image, $brochure->name) . PHP_EOL;
				continue;
			}

			$brochure->is_removed = 1;

			if ($brochure->save(false)) {
				$results[] = sprintf('File %s not exists. Brochure %s disabled.', $brochure->image, $brochure->name) . PHP_EOL;
			}
		}

		return $results;
	}
}