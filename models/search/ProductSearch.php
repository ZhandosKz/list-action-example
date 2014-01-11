<?php

namespace app\modules\shop\models\search;

use app\modules\shop;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class ProductSearch extends shop\components\FilterModelBase
{
    /**
     * Принимаемые моделью входящие данные
     */
    public $price;
    public $page_size = 20;

    /**
     * Правила валидации модели
     * @return array
     */
    public function rules()
    {
        return [
            // Обязательное поле
            ['price', 'required'],
            // Только числа, значение как минимум должна равняться единице
            ['page_size', 'integer', 'integerOnly' => true, 'min' => 1]
        ];
    }

    /**
     * Реализация логики выборки
     * @return ActiveDataProvider|\yii\data\DataProviderInterface
     */
    public function search()
    {
        // Создаём запрос на получение продуктов вместе категориями
        $query = shop\models\Product::find()
            ->with('categories');

        /**
         * Создаём DataProvider, указываем ему запрос, настраиваем пагинацию
         */
        $this->_dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => new Pagination([
                    'pageSize' => $this->page_size
                ])
        ]);

        // Если ошибок нет, фильтруем по цене
        if ($this->validate()) {
            $query->where('price <= :price', [':price' => $this->price]);
        }

        return $this->_dataProvider;
    }

    /**
     * Переопределяем метод компоновки моделей,
     * возвращаем так же категории
     * Это синтетический пример.
     * @return array|mixed
     */
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