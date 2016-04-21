<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use PrivateIT\modules\messenger\widgets\messages\components\ListView;

/** @var \PrivateIT\modules\messenger\models\Dialog $dialog */
/** @var \PrivateIT\modules\messenger\widgets\messages\forms\MessageForm $model */
/** @var \yii\web\View $this */

$search = \PrivateIT\modules\messenger\widgets\messages\search\MessageSearch::getInstance();
$dataProvider = $search->search($dialog);
?>

<?php \yii\widgets\Pjax::begin(); ?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => 'widget-messenger-messages-item',
    'summary' => '',
]) ?>

<?php \yii\widgets\Pjax::end(); ?>
