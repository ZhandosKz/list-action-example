<?php

namespace app\modules\shop\components;

use yii\base\Model;
use yii\data\DataProviderInterface;

abstract class FilterModelBase extends Model
{
    /**
     * @var DataProviderInterface
     */
    protected $_dataProvider;

    /**
     * @return DataProviderInterface
     */
    abstract public function search();

    /**
     * Получение результатов выборки
     * Этот метод часто переобределяется моделями поиска, например сгруппировать в под-массивы по датам и т.д.
     * @return mixed
     */
    public function buildModels()
    {
        return $this->_dataProvider->getModels();
    }

    public function getDataProvider()
    {
        return $this->_dataProvider;
    }
}