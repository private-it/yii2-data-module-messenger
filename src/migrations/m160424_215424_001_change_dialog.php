<?php
/**
 * Created by ERDConverter
 */

use yii\db\Schema;
use yii\db\Migration;

/**
 * m160424_215424_001_change_dialog
 *
 */
class m160424_215424_001_change_dialog extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->renameColumn(\PrivateIT\modules\messenger\models\Dialog::tableName(), 'inititator_user_id', 'initiator_user_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        
        $this->renameColumn(\PrivateIT\modules\messenger\models\Dialog::tableName(), 'initiator_user_id', 'inititator_user_id');
    }
}