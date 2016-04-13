<?php
/**
 * Created by ERDConverter
 */

use yii\db\Schema;
use yii\db\Migration;

/**
 * m160413_213550_001_create_member
 *
 */
class m160413_213550_001_create_member extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(\PrivateIT\modules\messenger\models\Member::tableName(), [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->defaultValue(0),
            'user_id' => $this->integer()->defaultValue(0),
            'status' => $this->integer()->defaultValue(0),
            'created_at' => $this->timestamp()->defaultValue(null),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable(\PrivateIT\modules\messenger\models\Member::tableName());
    }
}