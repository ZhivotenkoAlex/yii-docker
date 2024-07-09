<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "products_has_categories".
 *
 * The followings are the available columns in table 'products_has_categories':
 * @property integer $id
 * @property integer $product_id
 * @property integer $category_id
 *
 * @property Category $category
 * @property Product $product
 */
class ProductCategoryRelation extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'gazetki_pc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			[['product_id', 'category_id'], 'required'],
			[['product_id', 'category_id'], 'number', 'integerOnly'=>true]
		];
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
	public function getProduct()
	{
		return $this->hasOne(Product::class, ['id' => 'product_id']);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'product_id' => 'Product',
			'category_id' => 'Category',
		];
	}
}
