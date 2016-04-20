<?php
namespace PrivateIT\modules\messenger\widgets\form;

use PrivateIT\modules\messenger\models\Member;
use PrivateIT\modules\messenger\widgets\form\forms\MessageForm;
use PrivateIT\widgets\bootstrap\AbstractWidget;
use yii\web\Application;

class WidgetMessengerForm extends AbstractWidget
{
    /**
     * @var Member
     */
    public $member;
    /**
     * @var MessageForm
     */
    protected $_model;
    /**
     * @var MessageForm[]
     */
    static public $models;

    /**
     * @param Application $app
     * @param string $widgetId
     */
    static public function bootstrap($app, $widgetId = '0')
    {
        $model = new MessageForm();
        if ($model->load($app->request->post())) {
            // TODO учесть права доступа
            $model->submit();
        }
        static::$models[$widgetId] = $model;
    }

    /**
     * @inheritdoc
     */
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