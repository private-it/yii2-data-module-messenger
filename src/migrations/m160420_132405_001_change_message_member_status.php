<?php
/**
 * Created by ERDConverter
 */

use yii\db\Schema;
use yii\db\Migration;

/**
 * m160420_132405_001_change_message_member_status
 *
 */
class m160420_132405_001_change_message_member_status extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->renameColumn(\PrivateIT\modules\messenger\models\MessageMemberStatus::tableName(), 'satatus', 'status');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        
        $this->renameColumn(\PrivateIT\modules\messenger\models\MessageMemberStatus::tableName(), 'status', 'satatus');
    }
}