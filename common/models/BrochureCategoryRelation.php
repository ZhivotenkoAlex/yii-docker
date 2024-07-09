<?php

namespace common\models;

/**
 * This is the model class for table "products_has_categories".
 *
 * The followings are the available columns in table 'products_has_categories':
 * @property integer $id
 * @property integer $product_id
 * @property integer $category_id
 *
 * @property Category $category
 * @property Brochure $brochure
 */
class BrochureCategoryRelation extends \yii\db\ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'gazetki_bc';
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getBrochure()
	{
		return $this->hasOne(Brochure::class, ['id' => 'brochure_id']);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'brochure_id' => 'Brochure',
			'category_id' => 'Category',
			'page_number' => 'Page number', // number of the page to link to (for example for a product to be found)
		);
	}
}
