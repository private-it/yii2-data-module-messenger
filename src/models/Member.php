<?php
/**
 * Created by ERDConverter
 */
namespace PrivateIT\modules\messenger\models;

use PrivateIT\modules\messenger\MessengerModule;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * Member
 *
 * @property integer $id
 * @property integer $dialog_id
 * @property integer $user_id
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Dialog $dialog
 * @property MessageMemberStatus[] $messageMemberStatuses
 * @property Message[] $messages
 */
class Member extends ActiveRecord
{
    const STATUS_ARCHIVED = -1;
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * Get object statuses
     *
     * @return array
     */
    static function getStatuses()
    {
        return [
            static::STATUS_ARCHIVED => Yii::t('messenger/member', 'const.status.archived'),
            static::STATUS_DELETED => Yii::t('messenger/member', 'const.status.deleted'),
            static::STATUS_ACTIVE => Yii::t('messenger/member', 'const.status.active'),
        ];
    }

    /**
     * @inheritdoc
     * @return query\MemberActiveQuery the newly created [[ActiveQuery]] instance.
     */
    public static function find()
    {
        return parent::find();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return MessengerModule::tableName(__CLASS__);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => TimestampBehavior::className(),
            'value' => new Expression('NOW()'),
        ];
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('messenger/member', 'label.id'),
            'dialog_id' => Yii::t('messenger/member', 'label.dialog_id'),
            'user_id' => Yii::t('messenger/member', 'label.user_id'),
            'status' => Yii::t('messenger/member', 'label.status'),
            'created_at' => Yii::t('messenger/member', 'label.created_at'),
            'updated_at' => Yii::t('messenger/member', 'label.updated_at'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('messenger/member', 'hint.id'),
            'dialog_id' => Yii::t('messenger/member', 'hint.dialog_id'),
            'user_id' => Yii::t('messenger/member', 'hint.user_id'),
            'status' => Yii::t('messenger/member', 'hint.status'),
            'created_at' => Yii::t('messenger/member', 'hint.created_at'),
            'updated_at' => Yii::t('messenger/member', 'hint.updated_at'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributePlaceholders()
    {
        return [
            'id' => Yii::t('messenger/member', 'placeholder.id'),
            'dialog_id' => Yii::t('messenger/member', 'placeholder.dialog_id'),
            'user_id' => Yii::t('messenger/member', 'placeholder.user_id'),
            'status' => Yii::t('messenger/member', 'placeholder.status'),
            'created_at' => Yii::t('messenger/member', 'placeholder.created_at'),
            'updated_at' => Yii::t('messenger/member', 'placeholder.updated_at'),
        ];
    }

    /**
     * Get value from Id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set value to Id
     *
     * @param $value
     * @return $this
     */
    public function setId($value)
    {
        $this->id = $value;
        return $this;
    }

    /**
     * Get value from DialogId
     *
     * @return string
     */
    public function getDialogId()
    {
        return $this->dialog_id;
    }

    /**
     * Set value to DialogId
     *
     * @param $value
     * @return $this
     */
    public function setDialogId($value)
    {
        $this->dialog_id = $value;
        return $this;
    }

    /**
     * Get value from UserId
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set value to UserId
     *
     * @param $value
     * @return $this
     */
    public function setUserId($value)
    {
        $this->user_id = $value;
        return $this;
    }

    /**
     * Get value from Status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set value to Status
     *
     * @param $value
     * @return $this
     */
    public function setStatus($value)
    {
        $this->status = $value;
        return $this;
    }

    /**
     * Get value from CreatedAt
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set value to CreatedAt
     *
     * @param $value
     * @return $this
     */
    public function setCreatedAt($value)
    {
        $this->created_at = $value;
        return $this;
    }

    /**
     * Get value from UpdatedAt
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set value to UpdatedAt
     *
     * @param $value
     * @return $this
     */
    public function setUpdatedAt($value)
    {
        $this->updated_at = $value;
        return $this;
    }

    /**
     * Get relation Dialog
     *
     * @param string $class
     * @return query\DialogActiveQuery
     */
    public function getDialog($class = '\Dialog')
    {
        return $this->hasOne(static::findClass($class, __NAMESPACE__), ['id' => 'dialog_id']);
    }

    /**
     * Get relation MessageMemberStatus[]
     *
     * @param string $class
     * @return query\MessageMemberStatusActiveQuery
     */
    public function getMessageMemberStatuses($class = '\MessageMemberStatus')
    {
        return $this->hasMany(static::findClass($class, __NAMESPACE__), ['member_id' => 'id']);
    }

    /**
     * Get relation Message[]
     *
     * @param string $class
     * @return query\MessageActiveQuery
     */
    public function getMessages($class = '\Message')
    {
        return $this->hasMany(static::findClass($class, __NAMESPACE__), ['member_id' => 'id']);
    }

    /**
     * Присоединить пользователя в диалог
     *
     * @param $groupId
     * @param $userId
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    public static function joinToDialog($groupId, $userId)
    {
        $member = static::find()->andWhere([
            'group_id' => $groupId,
            'user_id' => $userId
        ])->one();
        if ($member) {
            return $member;
        }
        /** @var static $member */
        $member = Yii::createObject(static::className());
        $member->setDialogId($groupId);
        $member->setUserId($userId);
        $member->setStatus(static::STATUS_ACTIVE);
        if ($member->save(false)) {
            return $member;
        }
        return false;
    }

    /**
     * Добавить сообщение в диалог
     *
     * @param $text
     * @return mixed
     */
    public function addMessage($text)
    {
        return Message::send($this->getDialogId(), $this->getId(), $text);
    }
}
