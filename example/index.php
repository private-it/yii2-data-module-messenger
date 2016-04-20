<?php
use \PrivateIT\modules\messenger\models\Dialog;
use \PrivateIT\modules\messenger\models\Member;
require __DIR__ . '/bootstrap.php';

$view = (new yii\web\Application(
    array_replace_recursive(
        require(__DIR__ . '/config.php'),
        file_exists(__DIR__ . '/config-local.php') ? require __DIR__ . '/config-local.php' : []
    )
))->view;

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
$params = [
    'userId' => 77,
    'dialogId' => 5,
    'memberId' => 3,
];
prepare($params);

$dialog = Dialog::findOne($params['dialogId']);
$member = Member::findOne($params['memberId']);

\yii\bootstrap\BootstrapAsset::register($view);
?>
<html>
<?php $view->beginPage(); ?>
<head><?php $view->head() ?></head>
<body>
<?php $view->beginBody() ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6" style="padding: 50px; outline: 1px solid green;">

            <?= \PrivateIT\modules\messenger\widgets\messages\WidgetMessengerMessages::widget([
                'dialog' => $dialog,
                'member' => $member,
            ]) ?>

            <?= \PrivateIT\modules\messenger\widgets\form\WidgetMessengerForm::widget([
                'member' => $member,
            ]) ?>

        </div>
    </div>
</div>

<?php $view->endBody() ?>
</body>
<?php $view->endPage() ?>
</html>
