<?php

namespace PrivateIT\modules\messenger\widgets\messages;

use PrivateIT\modules\messenger\models\Dialog;
use PrivateIT\modules\messenger\models\Member;
use yii\base\Model;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;

class WidgetMessengerMessages extends Widget
{
    /**
     * @var Dialog
     */
    public $dialog;
    /**
     * @var Member
     */
    public $member;

    static public function bootstrap()
    {
        $model = new Model();
        if ($model->load($_POST)) {

        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->getContent();
    }

    public function getContent()
    {
        return $this->render('widget-messenger-messages', [
            'dialog' => $this->dialog,
            'member' => $this->member,
        ]);
    }

}