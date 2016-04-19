<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use PrivateIT\modules\messenger\widgets\messages\components\ListView;

/** @var integer $groupId */
/** @var \PrivateIT\modules\messenger\widgets\messages\forms\MessageForm $model */
/** @var \yii\web\View $this */

$search = \PrivateIT\modules\messenger\widgets\messages\search\MessageSearch::getInstance();
$dataProvider = $search->search($groupId);
?>

<?php \yii\widgets\Pjax::begin([
    'id' => 'messages-block'
]); ?>
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_message-row',
    'summary' => '',
]) ?>
<?php \yii\widgets\Pjax::end(); ?>

<div class="row">
    <?php \yii\widgets\Pjax::begin([
        'options' => [
            'class' => 'js-submit-message-form'
        ]
    ]); ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => 1]]) ?>
    <div class="col-md-10">
        Ваше сообщение
        <?= Html::activeTextarea($model, 'text', [
            'class' => 'js-user-message-textares'
        ]) ?>
    </div>

    <div class="col-md-2">
        <input type="submit" title="Отправить"/>
    </div>

    <?php ActiveForm::end() ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>
