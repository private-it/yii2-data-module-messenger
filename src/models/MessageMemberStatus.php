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
 * MessageMemberStatus
 *
 * @property integer $id
 * @property integer $member_id
 * @property integer $message_id
 * @property integer $satatus
 * @property string $updated_at
 * @property string $created_at
 *
 * @property Member $member
 * @property Message $message
 */
class MessageMemberStatus extends ActiveRecord
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
            static::STATUS_ARCHIVED => Yii::t('messenger/message-member-status', 'const.status.archived'),
            static::STATUS_DELETED => Yii::t('messenger/message-member-status', 'const.status.deleted'),
            static::STATUS_ACTIVE => Yii::t('messenger/message-member-status', 'const.status.active'),
        ];
    }

    /**
     * @inheritdoc
     * @return query\MessageMemberStatusActiveQuery the newly created [[ActiveQuery]] instance.
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
            'id' => Yii::t('messenger/message-member-status', 'label.id'),
            'member_id' => Yii::t('messenger/message-member-status', 'label.member_id'),
            'message_id' => Yii::t('messenger/message-member-status', 'label.message_id'),
            'satatus' => Yii::t('messenger/message-member-status', 'label.satatus'),
            'updated_at' => Yii::t('messenger/message-member-status', 'label.updated_at'),
            'created_at' => Yii::t('messenger/message-member-status', 'label.created_at'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('messenger/message-member-status', 'hint.id'),
            'member_id' => Yii::t('messenger/message-member-status', 'hint.member_id'),
            'message_id' => Yii::t('messenger/message-member-status', 'hint.message_id'),
            'satatus' => Yii::t('messenger/message-member-status', 'hint.satatus'),
            'updated_at' => Yii::t('messenger/message-member-status', 'hint.updated_at'),
            'created_at' => Yii::t('messenger/message-member-status', 'hint.created_at'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributePlaceholders()
    {
        return [
            'id' => Yii::t('messenger/message-member-status', 'placeholder.id'),
            'member_id' => Yii::t('messenger/message-member-status', 'placeholder.member_id'),
            'message_id' => Yii::t('messenger/message-member-status', 'placeholder.message_id'),
            'satatus' => Yii::t('messenger/message-member-status', 'placeholder.satatus'),
            'updated_at' => Yii::t('messenger/message-member-status', 'placeholder.updated_at'),
            'created_at' => Yii::t('messenger/message-member-status', 'placeholder.created_at'),
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
     * Get value from MessageId
     *
     * @return string
     */
    public function getMessageId()
    {
        return $this->message_id;
    }

    /**
     * Set value to MessageId
     *
     * @param $value
     * @return $this
     */
    public function setMessageId($value)
    {
        $this->message_id = $value;
        return $this;
    }

    /**
     * Get value from Satatus
     *
     * @return string
     */
    public function getSatatus()
    {
        return $this->satatus;
    }

    /**
     * Set value to Satatus
     *
     * @param $value
     * @return $this
     */
    public function setSatatus($value)
    {
        $this->satatus = $value;
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
     * Get relation Member
     *
     * @param string $class
     * @return query\MemberActiveQuery
     */
    public function getMember($class = '\Member')
    {
        return $this->hasOne(static::findClass($class, __NAMESPACE__), ['id' => 'member_id']);
    }

    /**
     * Get relation Message
     *
     * @param string $class
     * @return query\MessageActiveQuery
     */
    public function getMessage($class = '\Message')
    {
        return $this->hasOne(static::findClass($class, __NAMESPACE__), ['id' => 'message_id']);
    }

}
