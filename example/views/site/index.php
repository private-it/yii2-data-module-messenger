<?php
use \PrivateIT\modules\messenger\models\Dialog;
use \PrivateIT\modules\messenger\models\Member;

$params = Yii::$app->params;
$dialog = Dialog::findOne($params['dialogId']);
$member1 = Member::findOne($params['memberId']);
$member2 = Member::findOne($params['memberId']+1);

var_dump(sizeof($member2->unreadMessages));

if (sizeof($member2->unreadMessages) > 5) {
    foreach ($member2->unreadMessages as $unread) {
        $member2->readMessage($unread->getMessageId());
    }
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6" style="padding: 50px; outline: 1px solid green;">

            <?= \PrivateIT\modules\messenger\widgets\messages\WidgetMessengerMessages::widget([
                'id' => 'messenger-messages',
                'dialog' => $dialog,
                'member' => $member1,
            ]) ?>

            <?= \PrivateIT\modules\messenger\widgets\form\WidgetMessengerForm::widget([
                'id' => 'messenger-form',
                'member' => $member1,
            ]) ?>

        </div>
    </div>
</div>
