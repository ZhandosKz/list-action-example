<?php

namespace app\modules\shop\models\search;

use app\modules\shop;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class CategorySearch extends shop\components\FilterModelBase
{
    const PAGE_SIZE = 20;

    public function search()
    {
        $this->_dataProvider = new ActiveDataProvider([
            'query' => shop\models\Category::find(),
            'pagination' => new Pagination([
                    'pageSize' => self::PAGE_SIZE
                ])
        ]);

        return $this->_dataProvider;
    }
}