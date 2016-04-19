<?php
/**
 * Created by ERDConverter
 */
namespace PrivateIT\modules\messenger\models\query;

use PrivateIT\modules\messenger\models\Member;

/**
 * MemberActiveQuery
 *
 */
class MemberActiveQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     * @return Member[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Member|array|null
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
