<?php

namespace PrivateIT\modules\messenger\widgets\messages\forms;

use PrivateIT\modules\messenger\models\Group;
use PrivateIT\modules\messenger\models\Member;
use yii\base\Model;

class MessageForm extends Model
{
    public $owner;
    public $text;
    public $group_id;

    public function rules()
    {
        return [
            [
                'text', 'required'
            ],
        ];
    }

    public function submit()
    {
        if ($this->validate()) {
            $member = $this->getMember();
            if ($member) {
                if ($member->addMessage($this->text)) {
                    $this->text = '';
                    return true;
                }
            }
        }
        return false;
    }

    public function getMember()
    {
        $group = $this->getGroup();
        $member = $group->getMembers()->andWhere(['user_id' => $this->owner->id])->one();
        if (!$member) {
            $member = $group->addMember($this->owner->id);
        }
        return $member;
    }

    public function getGroup()
    {
        $group = null;
        if ($this->group_id) {
            $group = Group::find()->andWhere(['id' => $this->group_id])->one();
        }
        if (!$group) {
            $ownerId = $this->owner->id;
            $group = Group::find()
                ->andWhere([
                    'owner_id' => $ownerId,
                ])
                ->joinWith('members')->andWhere([
                    Member::tableName() . '.user_id' => $ownerId
                ])->one();
            if (!$group) {
                $group = new Group();
                $group->setOwnerId($ownerId);
                $group->setOwnerType(1);
                if ($group->save()) {
                    //
                }
            }
            $group->addMember($ownerId);
        }
        return $group;
    }
}