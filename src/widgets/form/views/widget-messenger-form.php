<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var \PrivateIT\modules\messenger\models\Member $member */
/** @var \PrivateIT\modules\messenger\widgets\form\forms\MessageForm $model */
/** @var \yii\web\View $this */

/** @var \PrivateIT\modules\messenger\widgets\form\WidgetMessengerForm $widget */
$widget = $this->context;
?>

<?php \yii\widgets\Pjax::begin(); ?>
<?php $form = ActiveForm::begin([
    'options' => [
        'data-pjax' => 1
    ]
]) ?>

<?= Html::hiddenInput('widget[cls]', \PrivateIT\modules\messenger\widgets\form\WidgetMessengerForm::className()) ?>
<?= Html::hiddenInput('widget[id]', $widget->getId()) ?>
<?= Html::activeHiddenInput($model, 'member_id', ['value' => $member->getId()]) ?>

<?= $form->field($model, 'text')->textarea() ?>
<input type="submit" title="Отправить"/>

<?php ActiveForm::end() ?>
<?php \yii\widgets\Pjax::end(); ?>
