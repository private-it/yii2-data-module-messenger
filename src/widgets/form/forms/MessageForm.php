<?php

namespace PrivateIT\modules\messenger\widgets\form\forms;

use PrivateIT\modules\messenger\models\Member;
use yii\base\Model;

class MessageForm extends Model
{
    /**
     * @var integer
     */
    public $member_id;
    /**
     * @var string
     */
    public $text;
    /**
     * @var Member
     */
    protected $_member;

    public function rules()
    {
        return [
            [
                ['member_id'], 'safe',
            ],
            [
                ['text'], 'required'
            ],
        ];
    }

    /**
     * @return Member
     */
    public function getMember()
    {
        if (!$this->_member) {
            if ($this->member_id) {
                $this->_member = Member::findOne($this->member_id);
            }
        }
        return $this->_member;
    }

    /**
     * @return bool
     */
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
            else {
                $this->addError('text', 'Участник диалога не найден.');
            }
        }
        return false;
    }
}