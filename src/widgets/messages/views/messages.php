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

<div class="scrolling-block js-scrolling-block">
    <?php \yii\widgets\Pjax::begin([
        'id' => 'messages-block'
    ]); ?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_message-row',
        'summary' => '',
    ]) ?>
    <div class="messages-bottom clearfix"></div>
    <?php \yii\widgets\Pjax::end(); ?>
</div>
<div class="row user-consultation__form">
    <?php \yii\widgets\Pjax::begin([
        'id' => 'messages-form',
        'options' => [
            'class' => 'js-submit-message-form'
        ]
    ]); ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => 1]]) ?>
    <div class="col-md-10">
        <div class="user-consultation__form-title clearfix">
            Ваше сообщение
        </div>
        <div class="user-consultation__form-textarea">
            <?= Html::activeTextarea($model, 'text', [
                'class' => 'js-user-message-textares'
            ]) ?>
        </div>
        <div class="user-consultation__form-attach clearfix">
            <div class="conversation__attach">
                <div class="conversation__attach-item">
                    <div class="conversation__attach-img conversation__attach-img_doc fa fa-file-text-o"
                         title="DOC-file-name.doc"></div>
                    <div class="conversation__attach-title">
                        DOC-file-name.doc
                    </div>
                    <div class="conversation__attach-delete"></div>
                </div>
                <div class="conversation__attach-item">
                    <div class="conversation__attach-img" title="name.png">
                        <img src="/img/attach/name.png">
                    </div>
                    <div class="conversation__attach-title">
                        name.png
                    </div>
                    <div class="conversation__attach-delete"></div>
                </div>
                <div class="conversation__attach-item">
                    <div class="conversation__attach-img" title="Long-long-long-name.png">
                        <img src="/img/attach/Long-long-long-name.png">
                    </div>
                    <div class="conversation__attach-title">
                        Long-long-long-name.png
                    </div>
                    <div class="conversation__attach-delete"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="user-consultation__form-button">
            <button class="add" type="button" title="Загрузить файлы"></button>
            <button class="submit" type="submit" title="Отправить"></button>
        </div>
    </div>
    <?php ActiveForm::end() ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>
