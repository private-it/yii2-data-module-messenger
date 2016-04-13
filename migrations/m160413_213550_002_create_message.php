<?php
/**
 * Created by ERDConverter
 */

use yii\db\Schema;
use yii\db\Migration;

/**
 * m160413_213550_002_create_message
 *
 */
class m160413_213550_002_create_message extends Migration
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

        $this->createTable(\PrivateIT\modules\messenger\models\Message::tableName(), [
            'id' => $this->primaryKey(),
            'member_id' => $this->integer()->defaultValue(0),
            'group_id' => $this->integer()->defaultValue(0),
            'text' => $this->text()->defaultValue(""),
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
        $this->dropTable(\PrivateIT\modules\messenger\models\Message::tableName());
    }
}