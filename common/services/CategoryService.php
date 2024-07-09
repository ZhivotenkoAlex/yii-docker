<?php

namespace common\services;

use common\models\Category;
use app\db\Firestore; 

class CategoryService extends \yii\base\Component
{
	/**
	 * @return array|Category[]
	 */
		private $firestore;

    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->firestore = new Firestore();
    }

    /**
	 * @return array|Category[]
	 */
    public function getAllForSidebar()
    {
        $database = $this->firestore->getDatabase();
        $categoriesCollection = $database->collection('gazetki_category');
        $sieciCategorySnapshot = $categoriesCollection->where('urlname', '=', 'siec')->documents();
        if ($sieciCategorySnapshot->isEmpty()) {
            return [];
        }
        $sieciCategoryId = $sieciCategorySnapshot->rows()[0]->data()['id'];
        $childCategoriesSnapshots = $categoriesCollection->where('parent_id', '=', $sieciCategoryId)
            ->orderBy('priority', 'DESC')
            ->orderBy('name')
            ->documents();
        $result = [];
        foreach ($childCategoriesSnapshots as $categorySnapshot) {
            if (!$categorySnapshot->exists()) {
                continue;
            }
            $result[] = [...$categorySnapshot->data(),'bc' => [],'gb' => []];
        }
        return $result;
    }
}
