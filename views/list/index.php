<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
/**
 * @var \yii\web\View $this
 * @var \yii\data\DataProviderInterface $dataProvider
 * @var \app\modules\shop\components\FilterModelBase $filterModel
 * @var ActiveForm: $form
 * @var string $requestType
 * @var bool $directPopulating
 */

// Формируем форму для поиска по safe аттрибутам
if (($safeAttributes = $filterModel->safeAttributes())) {
    echo Html::beginTag('div', ['class' => 'well']);
    $form = ActiveForm::begin([
            'method' => $requestType
        ]);
    foreach ($safeAttributes as $attribute) {
        echo $form->field($filterModel, $attribute)->textInput([
                'name' => (!$directPopulating) ? $attribute : null
            ]);
    }
    echo Html::submitInput('search', ['class' => 'btn btn-default']).
        Html::endTag('div');
    ActiveForm::end();
}


echo \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $filterModel
    ]);