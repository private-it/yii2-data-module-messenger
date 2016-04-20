<?php
use \PrivateIT\modules\messenger\models\Dialog;
use \PrivateIT\modules\messenger\models\Member;

require __DIR__ . '/bootstrap.php';

$app = (new yii\web\Application(
    array_replace_recursive(
        require(__DIR__ . '/config.php'),
        file_exists(__DIR__ . '/config-local.php') ? require __DIR__ . '/config-local.php' : []
    )
));

function prepare($params)
{
    $userId = $params['userId'];
    $dialogId = $params['dialogId'];
    $dialog = Dialog::findOne($dialogId);
    if (null == $dialog) {
        $dialog = new Dialog();
        $dialog->setId($dialogId);
        $dialog->setStatus(Member::STATUS_ACTIVE);
        $dialog->save();
    }

    $memberId = $params['memberId'];
    $member = Member::findOne($memberId);
    if (null == $member) {
        $member = new Member();
        $member->setId($memberId);
        $member->setUserId($userId);
        $member->setDialogId($dialogId);
        $member->setStatus(Member::STATUS_ACTIVE);
        $member->save();
    }
}

prepare(Yii::$app->params);

$app->run();