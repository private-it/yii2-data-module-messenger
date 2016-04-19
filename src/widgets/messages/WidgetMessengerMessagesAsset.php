<?php

namespace PrivateIT\modules\messenger\widgets\messages;

use yii\web\AssetBundle;

class WidgetMessengerMessagesAsset extends AssetBundle
{
    public $css = [
        'css/widget-messenger-messages.css',
    ];
    public $js = [
        'js/jquery-widget-messenger-messages.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
    public $publishOptions = ['forceCopy' => YII_DEBUG];

    public function init()
    {
        if (!$this->sourcePath) {
            $this->sourcePath = __DIR__ . '/assets';
        }
        parent::init();
    }
}