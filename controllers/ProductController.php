<?php

namespace app\modules\shop\controllers;

use yii\web\Controller;
use app\modules\shop\actions\ListAction;
use app\modules\shop\models\search\ProductSearch;

class ProductController extends Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => ListAction::className(),
                'filterModel' => new ProductSearch(),
                'directPopulating' => false,
                'view' => 'index'
            ]
        ];
    }
}