<?php
namespace PrivateIT\modules\messenger\widgets\form;

use PrivateIT\modules\messenger\models\Dialog;
use PrivateIT\modules\messenger\models\Member;
use PrivateIT\modules\messenger\widgets\form\forms\MessageForm;
use yii\base\Model;
use yii\base\Widget;
use yii\web\Application;
use yii\widgets\ActiveForm;

class WidgetMessengerForm extends Widget
{
    /**
     * @var MessageForm[]
     */
    static public $models;
    /**
     * @var Member
     */
    public $member;

    protected $_model;

    /**
     * @param Application $app
     * @param string $widgetId
     */
    static public function bootstrap($app, $widgetId = '0')
    {
        $model = new MessageForm();
        if ($model->load($app->request->post())) {
            $model->submit();
        }
        static::$models[$widgetId] = $model;
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
        return $this->render('widget-messenger-form', [
            'model' => $this->getModel(),
            'member' => $this->member,
        ]);
    }

    public function getModel()
    {
        if (empty($this->_model)) {
            if (isset(static::$models[$this->getId()])) {
                $this->_model = static::$models[$this->getId()];
            }
            else {
                $this->_model = new MessageForm();
            }
        }
        return $this->_model;
    }
}