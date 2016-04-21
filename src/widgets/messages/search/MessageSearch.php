<?php

namespace PrivateIT\modules\messenger\widgets\messages\search;

use PrivateIT\modules\messenger\models\Message;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class MessageSearch extends Model
{
    /**
     * @var static
     */
    static $_instance;

    /**
     * @return static
     */
    static public function getInstance()
    {
        if (static::$_instance === null) {
            static::$_instance = new static;
            static::$_instance->load(\Yii::$app->request->get());
        }
        return static::$_instance;
    }

    public function filter()
    {
        return $this;
    }

    public function search($dialog)
    {
        $query = Message::find();
        $query->orderBy(['id' => SORT_DESC]);

        $query->andWhere([
            'dialog_id' => $dialog->id
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_ASC
                ]
            ]
        ]);
        return $dataProvider;
    }

}