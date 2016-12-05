<?php
/**
 * Created by ERDConverter
 */
namespace PrivateIT\modules\messenger\models;

use PrivateIT\modules\messenger\MessengerModule;
use PrivateIT\modules\messenger\models\query\MessageMemberStatusActiveQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * Dialog
 *
 * @property integer $id
 * @property string $name
 * @property integer $initiator_user_id
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Member[] $members
 * @property Message[] $messages
 *
 * @property MessageMemberStatus[] $activeMessageStatuses
 * @property boolean $isActiveMember
 * @property integer $countActiveMessages
 */
class Dialog extends ActiveRecord
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
            static::STATUS_ARCHIVED => Yii::t('messenger/dialog', 'const.status.archived'),
            static::STATUS_DELETED => Yii::t('messenger/dialog', 'const.status.deleted'),
            static::STATUS_ACTIVE => Yii::t('messenger/dialog', 'const.status.active'),
        ];
    }

    /**
     * @inheritdoc
     * @return query\DialogActiveQuery the newly created [[ActiveQuery]] instance.
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
            'id' => Yii::t('messenger/dialog', 'label.id'),
            'name' => Yii::t('messenger/dialog', 'label.name'),
            'initiator_user_id' => Yii::t('messenger/dialog', 'label.initiator_user_id'),
            'status' => Yii::t('messenger/dialog', 'label.status'),
            'created_at' => Yii::t('messenger/dialog', 'label.created_at'),
            'updated_at' => Yii::t('messenger/dialog', 'label.updated_at'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('messenger/dialog', 'hint.id'),
            'name' => Yii::t('messenger/dialog', 'hint.name'),
            'initiator_user_id' => Yii::t('messenger/dialog', 'hint.initiator_user_id'),
            'status' => Yii::t('messenger/dialog', 'hint.status'),
            'created_at' => Yii::t('messenger/dialog', 'hint.created_at'),
            'updated_at' => Yii::t('messenger/dialog', 'hint.updated_at'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributePlaceholders()
    {
        return [
            'id' => Yii::t('messenger/dialog', 'placeholder.id'),
            'name' => Yii::t('messenger/dialog', 'placeholder.name'),
            'initiator_user_id' => Yii::t('messenger/dialog', 'placeholder.initiator_user_id'),
            'status' => Yii::t('messenger/dialog', 'placeholder.status'),
            'created_at' => Yii::t('messenger/dialog', 'placeholder.created_at'),
            'updated_at' => Yii::t('messenger/dialog', 'placeholder.updated_at'),
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
     * Get value from Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value to Name
     *
     * @param $value
     * @return $this
     */
    public function setName($value)
    {
        $this->name = $value;
        return $this;
    }

    /**
     * Get value from InitiatorUserId
     *
     * @return string
     */
    public function getInitiatorUserId()
    {
        return $this->initiator_user_id;
    }

    /**
     * Set value to InitiatorUserId
     *
     * @param $value
     * @return $this
     */
    public function setInitiatorUserId($value)
    {
        $this->initiator_user_id = $value;
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
     * Get relation Member[]
     *
     * @param string $class
     * @return query\MemberActiveQuery
     */
    public function getMembers($class = '\Member')
    {
        return $this->hasMany(static::findClass($class, __NAMESPACE__), ['dialog_id' => 'id']);
    }

    /**
     * Get relation Message[]
     *
     * @param string $class
     * @return query\MessageActiveQuery
     */
    public function getMessages($class = '\Message')
    {
        return $this->hasMany(static::findClass($class, __NAMESPACE__), ['dialog_id' => 'id']);
    }


    /**
     * @return boolean
     */
    public function getIsActiveMember()
    {
        return (boolean)MessageMemberStatus::find()
            ->joinWith(['member as member', 'message as message'])
            ->andWhere(['member.user_id' => \Yii::$app->user->getId()])
            ->andWhere(['message.dialog_id' => $this->id])
            ->limit(1)
            ->count();

    }

    /**
     * @return MessageMemberStatusActiveQuery
     */
    public function getActiveMessageStatuses()
    {
        return MessageMemberStatus::find()
            ->alias('t')
            ->joinWith(['member as member', 'message as message'])
            ->andWhere(['member.user_id' => \Yii::$app->user->getId()])
            ->andWhere(['message.dialog_id' => $this->id])
            ->andWhere(['t.status' => MessageMemberStatus::STATUS_ACTIVE]);

    }

    /**
     * @return integer
     */
    public function getCountActiveMessages()
    {
        return $this->isActiveMember ? $this->getActiveMessageStatuses()->count() : $this->getMessages()->count();
    }
}
