<?php

namespace PrivateIT\modules\messenger\widgets\messages;

use PrivateIT\modules\messenger\widgets\messages\forms\MessageForm;
use PrivateIT\modules\messenger\models\Group;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;

class WidgetMessengerMessages extends Widget
{
    /**
     * @var Group
     */
    public $group;
    public $blocked = false;
    public $newMessage = false;
    public $search = false;

    /**
     * @var array
     */
    public $options = ['class' => 'widget-messenger-messages'];

    /**
     * @var array
     */
    public $clientOptions = [];

    public function getContent()
    {
        /** @var MessageForm $model */
        $model = \Yii::createObject(MessageForm::className());
        $model->group_id = ArrayHelper::getValue($this->group, 'id');

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->submit()) {
                //\Yii::$app->response->refresh()->send();
//                \Yii::$app->end();
            }
        }

        return $this->render('messages', [
            'groupId' => $model->group_id,
            'model' => $model,
            'search' => $this->search,
            'blocked' => $this->blocked,
            'newMessage' => $this->newMessage,
        ]);
    }

    /**
     * Runs the widget.
     */
    public function run()
    {
        $id = $this->options['id'];
        $options = Json::htmlEncode($this->getClientOptions());

        $view = $this->getView();
        WidgetMessengerMessagesAsset::register($view);
        $view->registerJs("jQuery('#$id').widgetChatMessages($options);");

        return Html::tag('div', $this->getContent(), $this->options);
    }

    /**
     * Initializes the view.
     */
    public function init()
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
    }

    /**
     * Returns the options for the grid view JS widget.
     * @return array the options
     */
    protected function getClientOptions()
    {
        return ArrayHelper::merge([
            //'paramKey' => '',
        ], $this->clientOptions);
    }
}