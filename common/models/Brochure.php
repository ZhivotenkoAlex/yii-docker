<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for collection "gazetki_brochure".
 *
 * @property integer $id
 * @property string $name
 * @property integer $supplier_id
 * @property string $urlname
 * @property string (datetime YYYY-MM-DD HH:mm:ss) $start_date 
 * @property string (datetime YYYY-MM-DD HH:mm:ss) $end_date
 * @property string $image
 * @property integer $is_removed
 *
 * @property Supplier $supplier
 * @property Category $category
 * @property Page[] $pages
 */
class Brochure
{
	/**
	 * @return string
	 */
	public static function tableName()
	{
		return 'gazetki_brochure';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('supplier_id, title, start_date', 'required'),
			array('supplier_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			array('urlname', 'length', 'max' => 200),
			array('start_date, end_date, image', 'safe'),
			array('image', 'length', 'max' => 512)
		);
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'supplier_id' => 'Supplier',
			'name' => 'Title',
			'urlname' => 'Url name',
			'start_date' => 'Start date',
			'end_date' => 'End date',
			'image' => 'Image',
			'is_removed' => 'Is removed'
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
}
