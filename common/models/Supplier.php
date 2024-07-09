<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "gazetki_supplier".
 *
 * @property integer $id
 * @property integer $is_shown
 * @property string $name
 */
class Supplier extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'gazetki_supplier';
	}

	public static function primaryKey()
	{
		return 'id';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
			[['name'], 'length', 'max'=>200],
			[['id', 'name', 'is_shown'], 'safe'],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'is_shown' => 'Is shown'
		);
	}
}
