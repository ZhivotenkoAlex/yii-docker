<?php

namespace common\queries;

/**
 * This is the ActiveQuery class for [[\common\models\WhitelistedStores]].
 *
 * @see \common\models\WhitelistedStores
 */
class WhitelistedStoresQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return \app\models\WhitelistedStores[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\WhitelistedStores|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
