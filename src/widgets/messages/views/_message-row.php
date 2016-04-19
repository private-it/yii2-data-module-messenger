<?php
use Okkama\application\modules\messenger\data\Message;

/** @var bool $newMessage */
/** @var bool $blocked */
/** @var Message $model */
?>
<div class="row user-consultation_row user-consultation_row-answer">
    <div class="col-md-2">
        <div class="row">
            <div class="col-md-6 pull-left">
                <div class="new-tag">NEW</div>
            </div>
            <div class="col-md-6 pull-right">
                <img src="/img/avatar/user.png">
            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="conversation">
            <div class="conversation__title clearfix ">
                <div class="conversation__name fll">Васнецов Антон Михайлович</div>
                <div class="conversation__status fll">Врач-гастроэнтеролог</div>
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

<div class="row">
    <div class="col-md-12 mb50">
        <div class="mb30"></div>
    </div>
</div>
