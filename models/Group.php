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
 * Group
 *
 * @property integer $id
 * @property integer $owner_id
 * @property integer $owner_type
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Member[] $members
 * @property Message[] $messages
 */
class Group extends ActiveRecord
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
            static::STATUS_ARCHIVED => Yii::t('messenger/group', 'const.status.archived'),
            static::STATUS_DELETED => Yii::t('messenger/group', 'const.status.deleted'),
            static::STATUS_ACTIVE => Yii::t('messenger/group', 'const.status.active'),
        ];
    }

    /**
     * @inheritdoc
     * @return query\GroupActiveQuery the newly created [[ActiveQuery]] instance.
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
            'id' => Yii::t('messenger/group', 'label.id'),
            'owner_id' => Yii::t('messenger/group', 'label.owner_id'),
            'owner_type' => Yii::t('messenger/group', 'label.owner_type'),
            'created_at' => Yii::t('messenger/group', 'label.created_at'),
            'updated_at' => Yii::t('messenger/group', 'label.updated_at'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('messenger/group', 'hint.id'),
            'owner_id' => Yii::t('messenger/group', 'hint.owner_id'),
            'owner_type' => Yii::t('messenger/group', 'hint.owner_type'),
            'created_at' => Yii::t('messenger/group', 'hint.created_at'),
            'updated_at' => Yii::t('messenger/group', 'hint.updated_at'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributePlaceholders()
    {
        return [
            'id' => Yii::t('messenger/group', 'placeholder.id'),
            'owner_id' => Yii::t('messenger/group', 'placeholder.owner_id'),
            'owner_type' => Yii::t('messenger/group', 'placeholder.owner_type'),
            'created_at' => Yii::t('messenger/group', 'placeholder.created_at'),
            'updated_at' => Yii::t('messenger/group', 'placeholder.updated_at'),
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
     * Get value from OwnerId
     *
     * @return string
     */
    public function getOwnerId()
    {
        return $this->owner_id;
    }

    /**
     * Set value to OwnerId
     *
     * @param $value
     * @return $this
     */
    public function setOwnerId($value)
    {
        $this->owner_id = $value;
        return $this;
    }

    /**
     * Get value from OwnerType
     *
     * @return string
     */
    public function getOwnerType()
    {
        return $this->owner_type;
    }

    /**
     * Set value to OwnerType
     *
     * @param $value
     * @return $this
     */
    public function setOwnerType($value)
    {
        $this->owner_type = $value;
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
        return $this->hasMany(static::findClass($class, __NAMESPACE__), ['group_id' => 'id']);
    }

    /**
     * Get relation Message[]
     *
     * @param string $class
     * @return query\MessageActiveQuery
     */
    public function getMessages($class = '\Message')
    {
        return $this->hasMany(static::findClass($class, __NAMESPACE__), ['group_id' => 'id']);
    }

    /**
     * Добавить пользователя в группу
     *
     * @param $userId
     * @return mixed
     */
    public function addMember($userId)
    {
        return Member::joinToGroup($this->getId(), $userId);
    }
}
