<?php

namespace common\services;

use common\models\Brochure;
use common\models\Category;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\Expression;
use yii\httpclient\Client as HttpClient;
use app\db\Firestore; 

class BrochureService extends \yii\base\Component
{
	/**
	 * @param Category $category
	 *
	 * @return DataProviderInterface
	 */

	private $firestore;

	public function __construct($config = [])
	{
		parent::__construct($config);
		$this->firestore = new Firestore();
	}
	public function getActualBrochures($category)
	{

		$database = $this->firestore->getDatabase();
		$bcCollection = $database->collection('gazetki_bc');
		$gbCollection = $database->collection('gazetki_brochure');
		$categoryId = $category['id'];
		$bcDocuments = $bcCollection->where('category_id', '=', $categoryId)->documents();
		$actualBrochures = [];
		foreach ($bcDocuments as $bcDocument) {
            if (!$bcDocument->exists()) {
                    continue;
                }
        $brochureId = $bcDocument->data()['brochure_id'];

        $gbDocuments = $gbCollection->where('id', '=', $brochureId)
            ->where('is_removed', '=', '0')
            ->where('start_date', '>', (new \DateTime('2022-09-23'))->format('Y-m-d'))
            ->documents();

            foreach ($gbDocuments as $gbDocument) {
                if (!$gbDocument->exists()) {
                            continue;
             	}

			$actualBrochures[] = $gbDocument->data();
			}
		}
		return $actualBrochures;
	}

	/**
	 * @param Category $category
	 *
	 * @return DataProviderInterface
	 */
	public function getArchiveBrochures($category)
	{
		$database = $this->firestore->getDatabase();
		$bcCollection = $database->collection('gazetki_bc');
		$gbCollection = $database->collection('gazetki_brochure');
		$categoryId = $category['id'];
		$bcDocuments = $bcCollection->where('category_id', '=', $categoryId)->documents();
		$actualBrochures = [];
		foreach ($bcDocuments as $bcDocument) {
            if (!$bcDocument->exists()) {
                    continue;
                }
        $brochureId = $bcDocument->data()['brochure_id'];

        $gbDocuments = $gbCollection->where('id', '=', $brochureId)
            ->where('is_removed', '=', '0')
            ->where('start_date', '<', (new \DateTime('2022-09-23'))->format('Y-m-d'))
            ->documents();

            foreach ($gbDocuments as $gbDocument) {
                if (!$gbDocument->exists()) {
                            continue;
             	}

			$actualBrochures[] = $gbDocument->data();
			}
		}
		return $actualBrochures;
	}

	// /**
	//  * @param $searchString
	//  *
	//  * @return DataProviderInterface
	//  */
	// public function search($searchString): DataProviderInterface
	// {
	// 	$searchString = mb_convert_case($searchString, MB_CASE_LOWER);

	// 	return new ActiveDataProvider([
	// 		'query' => Brochure::find()
	// 			->innerJoinWith('category', false)
	// 			->andWhere(['or',
	// 				['like', 'lower(gazetki_brochure.name)', $searchString],
	// 				['like', 'lower(gazetki_category.name)', $searchString]
	// 			]),
	// 		'pagination' => [
	// 			'pageParam' => 'brochures-page',
	// 			'pageSizeParam' => 'brochures-per-page',
	// 			'defaultPageSize' => 12
	// 		]
	// 	]);
	// }

	public function getBrochure($brochureName)
	{
		$database = $this->firestore->getDatabase();
		$brochure = $this->firestore->getDocumentByFieldValue('gazetki_brochure', 'urlname', $brochureName);
		$brochureId = $brochure['id'];
		$pages = [];
		
		$pageSnapshots = $database->collection('gazetki_page')
		->where('brochure_id', '=', $brochureId)
		->documents();


		foreach ($pageSnapshots as $page) {
			  if (!$page->exists()) {
                continue;
            }
			$pages[] = $page->data();
		}
		
		usort($pages, function($a, $b) {
   			 $numA = intval($a['number']);
   			 $numB = intval($b['number']);

    		return $numA <=> $numB;
		});
		$supplierId = $pages[0]['supplier_id'];
		$supplier = $this->firestore->getDocumentByFieldValue('gazetki_supplier', 'id', $supplierId);
		return [
			...$brochure,
			'pages' => $pages,
			'category' => $supplier
		];
	}

	/**
	 * @param $filename
	 *
	 * @return bool
	 * @throws yiibaseInvalidConfigException
	 * @throws \yii\httpclient\Exception
	 */
	public function remoteFileExists($filename)
	{
		$response = (new HttpClient())
			->createRequest()
			->setMethod('HEAD')
			->setUrl($filename)
			->send();

		return $response->isOk;
	}
}