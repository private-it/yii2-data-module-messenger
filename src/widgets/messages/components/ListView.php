<?php

namespace PrivateIT\modules\messenger\widgets\messages\components;

class ListView extends \yii\widgets\ListView
{
    /**
     * @inheritdoc
     */
    public function renderItems()
    {
        $models = $this->dataProvider->getModels();
        $models = array_reverse($models);
        $keys = $this->dataProvider->getKeys();
        $rows = [];
        foreach (array_values($models) as $index => $model) {
            $rows[] = $this->renderItem($model, $keys[$index], $index);
        }

        return implode($this->separator, $rows);
    }
}