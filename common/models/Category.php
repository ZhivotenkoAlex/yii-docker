<?php

namespace common\models;

/**
 * This is the model class for collection "gazetki_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $urlname
 * @property integer $parent_id
 * @property integer $same_as_category_id
 * @property integer $has_products
 * @property integer $priority
 * @property integer $prioritaire
 *
 * @property Product[] $products
 * @property Brochure[] $brochures
 */
class Category
{
	/**
	 * @return string
	 */
	public static function tableName()
	{
		return 'gazetki_category';
	}

	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			[['parent_id'], 'integer'],
			[['name'], 'string', 'max' => 128],
			[['urlname'], 'string', 'max' => 200],
		];
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'parent_id' => 'Parent',
		);
	}
}