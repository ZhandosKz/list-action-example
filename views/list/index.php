<?php
/**
 * @var \yii\data\DataProviderInterface $dataProvider
 * @var \app\modules\shop\components\FilterModelBase $filterModel
 */
echo \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $filterModel
    ]);