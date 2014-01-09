<?php

namespace app\modules\shop\models\search;

use app\modules\shop;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class ProductSearch extends shop\components\FilterModelBase
{
    public $price;

    public $page_size = 20;

    public function rules()
    {
        return [
            ['price', 'required'],
            ['page_size', 'integer', 'integerOnly' => true, 'min' => 1]
        ];
    }

    public function search()
    {
        $query = shop\models\Product::find()
            ->with('categories');

        $this->_dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => new Pagination([
                    'pageSize' => $this->page_size
                ])
        ]);

        if ($this->validate()) {
            $query->where('price <= :price', [':price' => $this->price]);
        }

        return $this->_dataProvider;
    }

    public function buildModels()
    {
        $result = [];

        /**
         * @var shop\models\Product $product
         */
        foreach ($this->_dataProvider->getModels() as $product) {
            $result[] = array_merge($product->getAttributes(), [
                    'categories' => $product->categories
                ]);
        }

        return $result;
    }
}