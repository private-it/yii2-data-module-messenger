<?php
/**
 * Created by ERDConverter
 */
namespace PrivateIT\modules\messenger;

use yii\base\Module;
use yii\helpers\StringHelper;
use yii\helpers\Inflector;
use yii\db\ActiveRecord;
use Yii;

/**
 * Class MessengerModule
 *
 * @package PrivateIT\modules\messenger
 */
class MessengerModule extends Module
{
    /**
     * Table prefix for ActiveRecord tables
     * @var string|array|callable
     */
    public $tablePrefix = 'messenger_';

    /**
     * Custom table name for ActiveRecord by className
     * @var array
     */
    public $tableNames = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['messenger/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => __DIR__ . '/messages',
        ];
    }

    /**
     * @return string
     */
    static function id()
    {
        return Inflector::slug(__NAMESPACE__);
    }

    /**
     * @return string
     */
    public static function getInstance()
    {
        /** @var static $module */
        if (!Yii::$app->hasModule(static::id())) {
            Yii::$app->setModule(static::id(), [
                'class' => static::className()
            ]);
        }
        return Yii::$app->getModule(static::id());
    }

    /**
     * @param string|ActiveRecord $class
     * @return string
     */
    public static function tableName($class)
    {
        /** @var static $module */
        $module = static::getInstance();

        if (array_key_exists($class::className(), $module->tableNames)) {
            return $module->tableNames[$class::className()];
        }

        if (is_callable($module->tablePrefix)) {
            $tableName = call_user_func($module->tablePrefix, $class);
            if ($tableName) {
                return $tableName;
            }
        }

        $tableName = Inflector::camel2id(StringHelper::basename($class), '_');
        return '{{%' . $module->tablePrefix . $tableName . '}}';
    }
}