<?php

namespace common\models;

use yii\data\DataProviderInterface;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'products':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property integer $program_id
 * @property integer $category_id
 *
 * @property Product $product
 * @property Page $page
 */
class Product extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'gazetki_product';
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
    public function getBrochure()
    {
        return $this->hasOne(Brochure::class, ['id' => 'brochure_id']);
    }

	/**
	 * @return \yii\db\ActiveQuery
	 */
    public function getPage()
    {
        return $this->hasOne(Page::class, ['id' => 'page_id']);
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'image' => 'Picture',
			'brochure_id' => 'Supplier',
			'page_id' => 'Page'
		);
	}
	
	// TODO: change for a new version of backend
	public function getPicture () {
		if (
			strpos($this->image,'https://') === FALSE && 
			strpos($this->image,'http://') === FALSE &&
			strpos($this->image,'//') !== 0 
		) {
			return '/uploads/'.$this->image;
		} else {
			return $this->image;
		}
	}

	/**
	 * @param $searchString
	 * @param $page
	 *
	 * @return DataProviderInterface
	 */
    public static function searchProducts($searchString): DataProviderInterface
    {
		$dataProvider = new ActiveDataProvider([
            'query' => self::find()
	            ->innerJoinWith('brochure', false)
                ->andWhere(['like', 'lower(gazetki_product.name)', mb_convert_case($searchString, MB_CASE_LOWER)]),
//                ->andWhere(['is_removed' => 0]),
            'pagination' => [
	            'pageParam' => 'products-page',
	            'pageSizeParam' => 'products-per-page',
				'defaultPageSize' => 12
            ]
        ]);

        return $dataProvider;
    }
}
