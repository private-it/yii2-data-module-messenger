<?php
require __DIR__ . '/bootstrap.php';

$view = (new yii\web\Application(
    array_replace_recursive(
        require(__DIR__ . '/config.php'),
        file_exists(__DIR__ . '/config-local.php') ? require __DIR__ . '/config-local.php' : []
    )
))->view;

$user = (object)['id' => 777];

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
                'owner' => $user,
                'group' => new \PrivateIT\modules\messenger\models\Group()
            ]) ?>

        </div>
        <div class="col-sm-6" style="padding: 50px; outline: 1px solid green;">

            <?= \PrivateIT\modules\messenger\widgets\messages\WidgetMessengerMessages::widget([
                'owner' => $user,
                'group' => new \PrivateIT\modules\messenger\models\Group()
            ]) ?>

        </div>
    </div>
</div>

<?php $view->endBody() ?>
</body>
<?php $view->endPage() ?>
</html>
