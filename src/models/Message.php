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
 * Message
 *
 * @property integer $id
 * @property integer $member_id
 * @property integer $group_id
 * @property string $text
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Group $group
 * @property Member $member
 */
class Message extends ActiveRecord
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
            static::STATUS_ARCHIVED => Yii::t('messenger/message', 'const.status.archived'),
            static::STATUS_DELETED => Yii::t('messenger/message', 'const.status.deleted'),
            static::STATUS_ACTIVE => Yii::t('messenger/message', 'const.status.active'),
        ];
    }

    /**
     * @inheritdoc
     * @return query\MessageActiveQuery the newly created [[ActiveQuery]] instance.
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
            'id' => Yii::t('messenger/message', 'label.id'),
            'member_id' => Yii::t('messenger/message', 'label.member_id'),
            'group_id' => Yii::t('messenger/message', 'label.group_id'),
            'text' => Yii::t('messenger/message', 'label.text'),
            'status' => Yii::t('messenger/message', 'label.status'),
            'created_at' => Yii::t('messenger/message', 'label.created_at'),
            'updated_at' => Yii::t('messenger/message', 'label.updated_at'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('messenger/message', 'hint.id'),
            'member_id' => Yii::t('messenger/message', 'hint.member_id'),
            'group_id' => Yii::t('messenger/message', 'hint.group_id'),
            'text' => Yii::t('messenger/message', 'hint.text'),
            'status' => Yii::t('messenger/message', 'hint.status'),
            'created_at' => Yii::t('messenger/message', 'hint.created_at'),
            'updated_at' => Yii::t('messenger/message', 'hint.updated_at'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributePlaceholders()
    {
        return [
            'id' => Yii::t('messenger/message', 'placeholder.id'),
            'member_id' => Yii::t('messenger/message', 'placeholder.member_id'),
            'group_id' => Yii::t('messenger/message', 'placeholder.group_id'),
            'text' => Yii::t('messenger/message', 'placeholder.text'),
            'status' => Yii::t('messenger/message', 'placeholder.status'),
            'created_at' => Yii::t('messenger/message', 'placeholder.created_at'),
            'updated_at' => Yii::t('messenger/message', 'placeholder.updated_at'),
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
     * Get value from MemberId
     *
     * @return string
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * Set value to MemberId
     *
     * @param $value
     * @return $this
     */
    public function setMemberId($value)
    {
        $this->member_id = $value;
        return $this;
    }

    /**
     * Get value from GroupId
     *
     * @return string
     */
    public function getGroupId()
    {
        return $this->group_id;
    }

    /**
     * Set value to GroupId
     *
     * @param $value
     * @return $this
     */
    public function setGroupId($value)
    {
        $this->group_id = $value;
        return $this;
    }

    /**
     * Get value from Text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set value to Text
     *
     * @param $value
     * @return $this
     */
    public function setText($value)
    {
        $this->text = $value;
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
     * Get relation Group
     *
     * @param string $class
     * @return query\GroupActiveQuery
     */
    public function getGroup($class = '\Group')
    {
        return $this->hasOne(static::findClass($class, __NAMESPACE__), ['id' => 'group_id']);
    }

    /**
     * Get relation Member
     *
     * @param string $class
     * @return query\MemberActiveQuery
     */
    public function getMember($class = '\Member')
    {
        return $this->hasOne(static::findClass($class, __NAMESPACE__), ['id' => 'member_id']);
    }

    public static function send($groupId, $memberId, $text){
        /** @var static $message */
        $message = Yii::createObject(static::className());
        $message->setGroupId($groupId);
        $message->setMemberId($memberId);
        $message->setText($text);
        $message->setStatus(static::STATUS_ACTIVE);
        if ($message->save(false)) {
            return $message;
        }
        return false;
    }
}
