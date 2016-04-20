<?php
use PrivateIT\modules\messenger\models\Message;

/** @var bool $newMessage */
/** @var bool $blocked */
/** @var Message $model */
?>
<div class="row">
    <div class="col-md-10">
        <div class="conversation">
            <div class="conversation__title clearfix ">
                <div class="conversation__time flr">
                    <?= Yii::$app->formatter->asDatetime($model->getCreatedAt()) ?>
                </div>
            </div>
            <div class="conversation__body clearfix ">
                <div class="conversation__text"><?= $model->getText() ?></div>
            </div>
        </div>
    </div>
</div>
