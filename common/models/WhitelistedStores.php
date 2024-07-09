<?php

namespace common\models;

/**
 * This is the model class for table "leaflets_whitelisted_stores".
 *
 * @property int $id
 * @property string $name
 */
class WhitelistedStores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'leaflets_whitelisted_stores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\queries\WhitelistedStoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\queries\WhitelistedStoresQuery(get_called_class());
    }
}
