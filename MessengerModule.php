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
     * @return string
     */
    static function id()
    {
        return Inflector::slug(__NAMESPACE__);
    }

    /**
     * @param string|ActiveRecord $class
     * @return string
     */
    public static function tableName($class)
    {
        /** @var static $module */
        $module = Yii::$app->getModule(static::id());

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