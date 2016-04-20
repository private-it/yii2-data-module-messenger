<?php
use \PrivateIT\modules\messenger\models\Dialog;
use \PrivateIT\modules\messenger\models\Member;

$params = Yii::$app->params;
$dialog = Dialog::findOne($params['dialogId']);
$member = Member::findOne($params['memberId']);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6" style="padding: 50px; outline: 1px solid green;">

            <?= \PrivateIT\modules\messenger\widgets\messages\WidgetMessengerMessages::widget([
                'id' => 'messenger-messages',
                'dialog' => $dialog,
                'member' => $member,
            ]) ?>

            <?= \PrivateIT\modules\messenger\widgets\form\WidgetMessengerForm::widget([
                'id' => 'messenger-form',
                'member' => $member,
            ]) ?>

        </div>
    </div>
</div>
