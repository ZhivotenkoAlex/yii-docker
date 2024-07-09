<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'products':
 * @property integer $id
 * @property string $title
 * @property integer $supplier_id
 * @property string (datetime YYYY-MM-DD HH:mm:ss) $start_date 
 * @property string (datetime YYYY-MM-DD HH:mm:ss) $end_date
 * @property string $image
 *
 * @property Brochure $brochure
 */
class Page extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'gazetki_page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('supplier_id, brochure_id, number', 'required'),
			array('supplier_id, number', 'numerical', 'integerOnly'=>true),
			array('image', 'length', 'max' => 512)
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'supplier_id' => 'Supplier',
			'brochure_id' => 'Brochure',
			'number' => 'Number',
			'image' => 'Image',
		);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getBrochure()
	{
		return $this->hasOne(Brochure::class, ['id' => 'brochure_id']);
	}
	
	// TODO: change for a new version of backend
	public function getPicture()
	{
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

    public function getImage()
    {
        return str_replace(['.jpg', '.jpeg', '.png'], '.webp', $this->image);
    }
}
