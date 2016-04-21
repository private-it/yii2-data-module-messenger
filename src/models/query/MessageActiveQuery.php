<?php
/**
 * Created by ERDConverter
 */
namespace PrivateIT\modules\messenger\models\query;

use PrivateIT\modules\messenger\models\Message;

/**
 * MessageActiveQuery
 *
 */
class MessageActiveQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     * @return Message[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Message|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /*
    public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }
    */
}
