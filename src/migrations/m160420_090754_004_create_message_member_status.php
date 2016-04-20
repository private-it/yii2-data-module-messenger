<?php
/**
 * Created by ERDConverter
 */

use yii\db\Schema;
use yii\db\Migration;

/**
 * m160420_090754_004_create_message_member_status
 *
 */
class m160420_090754_004_create_message_member_status extends Migration
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

        $this->createTable(\PrivateIT\modules\messenger\models\MessageMemberStatus::tableName(), [
            'id' => $this->primaryKey(),
            'member_id' => $this->integer()->defaultValue(0),
            'message_id' => $this->integer()->defaultValue(0),
            'satatus' => $this->integer()->defaultValue(0),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'created_at' => $this->timestamp()->defaultValue(null),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable(\PrivateIT\modules\messenger\models\MessageMemberStatus::tableName());
    }
}