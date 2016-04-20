<?php

namespace PrivateIT\modules\messenger\widgets\messages;

use PrivateIT\modules\messenger\models\Dialog;
use PrivateIT\modules\messenger\models\Member;
use PrivateIT\widgets\bootstrap\AbstractWidget;
use yii\base\Model;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Json;

class WidgetMessengerMessages extends AbstractWidget
{
    /**
     * @var Dialog
     */
    public $dialog;
    /**
     * @var Member
     */
    public $member;

    static public function bootstrap($app, $widgetId = '0')
    {
    }

    public function getContent()
    {
        return $this->render('widget-messenger-messages', [
            'dialog' => $this->dialog,
            'member' => $this->member,
        ]);
    }


}