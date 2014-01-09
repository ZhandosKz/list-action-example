<?php

namespace app\modules\shop\controllers;

use yii\web\Controller;
use app\modules\shop\actions\ListAction;
use app\modules\shop\models\search\CategorySearch;

class CategoryController extends Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => ListAction::className(),
                'filterModel' => new CategorySearch(),
                'directPopulating' => false,
                'paginationAsHTML' => true
            ]
        ];
    }
}