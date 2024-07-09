<?php

namespace common\services;

use common\models\Brochure;
use common\models\Supplier;
use common\models\WhitelistedStores;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class LeafletService extends \yii\base\Component
{
	/**
	 * @param $legacy
	 *
	 * @return array
	 */
	public function processLeafletsArray($legacy = false)
	{
		if ($legacy) {
			return $this->processLeafletsArrayLegacy();
		}

		$result = [];

		$brochures = Brochure::find()
			->andWhere([
				'>=', 'end_date', new Expression('DATE_SUB(NOW(), INTERVAL 3 MONTH)')
			])
			->andWhere(['is_removed' => 0])
			->all();

		$whitelist = $this->getWhitelistedNamesArray();

		/** @var Brochure $brochure */
		foreach ($brochures as $brochure) {
			/** @var Supplier $store */
			$store = $brochure->supplier;

			if (!in_array($store->name, $whitelist)) {
				continue;
			}

			$logo = 'https://images.blovly.com/stores/' . str_replace(' ', '_', $store->name) . '/thumbnail.jpg';

			if (!array_key_exists($store->hash, $result)) {
				$result[$store->hash] = [
					'name' => $store->name,
					'logo' => $logo,
					'images' => []
				];
			}

			$result[$store->hash]['images'][$brochure->hash] = [
				'name' => $brochure->name,
				'pages' => []
			];

			foreach ($brochure->pages as $page) {
				$result[$store->hash]['images'][$brochure->hash]['pages'][] = $page->image;
			}
		}

		return $result;
	}

	/**
	 * @return array
	 */
	private function processLeafletsArrayLegacy()
	{
		$json = json_decode(file_get_contents("https://s3.eu-central-1.amazonaws.com/images.blovly.com/stores/blix.json"));
		$whitelist = $this->getWhitelistedNamesArray();

		$systemPath = "/mnt/blovly-images/";
		$urlPath = "https://images.blovly.com/";

		array_walk($json, function ($store) {
			$store->name = str_replace('gazetka promocyjna', '', $store->name);
			$store->name = trim($store->name);
		});

		foreach ($json as $key => &$store)
		{
			if (!in_array($store->name, $whitelist)) {
				unset($json[$key]);
				continue;
			}

			$store->logo = str_replace($systemPath, $urlPath, $store->logo);

			foreach ($store->images as &$images) {
				foreach ($images as &$image) {
					$image = urldecode(str_replace($systemPath, $urlPath, $image));
				}
			}
		}

		usort($json, array($this, "compareNames"));

		$finalArray = [];

		foreach ($json as $store) {
			$storeArray = [
				"name" => $store->name,
				"logo" => $store->logo,
				"images" => []
			];

			foreach ($store->images as $nameKey => $imagesList) {
				$storeArray["images"][md5($nameKey)] = [];
				$storeArray["images"][md5($nameKey)]["name"] = $nameKey;
				$storeArray["images"][md5($nameKey)]["pages"] = [];

				foreach ($imagesList as $image) {
					array_push($storeArray["images"][md5($nameKey)]["pages"], $image);
				}
			}

			$finalArray[md5($store->name)] = $storeArray;
		}

		return $finalArray;
	}

	/**
	 * @return array
	 */
	public function getWhitelistedNamesArray(): array
	{
		$names = ArrayHelper::getColumn(WhitelistedStores::find()->all(), 'name');

		array_map('trim', $names);

		return $names;
	}

	/**
	 * @param $a
	 * @param $b
	 *
	 * @return int
	 */
	private function compareNames($a, $b)
	{
		return strcmp($a->name, $b->name);
	}
}