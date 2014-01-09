<?php

namespace app\modules\shop\actions;

use Yii;
use yii\base;
use yii\web\Response;
use app\modules\shop\components\FilterModelBase;
use yii\widgets\LinkPager;

class ListAction extends base\Action
{

    /**
     * Модель поиска
     * @var FilterModelBase
     */
    protected $_filterModel;

    /**
     * Анонимная-функция запускаемая в случае ошибки валидации модели поиска
     * @var callable
     */
    protected $_validationFailedCallback;

    /**
     * Метод вставки данных из запроса,
     * Если true, то данные в запросе должны быть в под-массиве e.g. $_GET/$_POST[SearchModel][attribute]
     * @var bool
     */
    public $directPopulating = true;

    /**
     * Метод получение пагинации, если true, то получаем уже готовый html пагинации,
     * нужно для AJAX запросов
     * @var bool
     */
    public $paginationAsHTML = false;

    /**
     * Тип запроса
     * @var string
     */
    public $requestType = 'get';

    /**
     * Пусть до представления
     * @var string
     */
    public $view = '@app/modules/shop/views/list/index';

    public function run()
    {
        if (!$this->_filterModel) {
            throw new base\ErrorException('Не указана модель поиска');
        }

        $request = Yii::$app->request;

        // Проставляем данные
        $data = (strtolower($this->requestType) === 'post' && $request->isPost) ? $_POST : $_GET;
        $this->_filterModel->load(($this->directPopulating) ? $data : [$this->_filterModel->formName() => $data]);

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
        }

        // Здесь определяем что делать при ajax запросе и провале валидации
        if ($request->isAjax && !$this->_filterModel->validate()) {

            return (is_callable($this->_validationFailedCallback))
                ? call_user_func($this->_validationFailedCallback, $this->_filterModel)
                : [
                    'error' => current($this->_filterModel->getErrors())
                ];
        }

        // Производим выборку в моделей поиска
        $this->_filterModel->search();

        if (!($dataProvider = $this->_filterModel->getDataProvider())) {
            throw new base\ErrorException('Не проинициализирован DataProvider');
        }

        if ($request->isAjax) {
            // Возвращаем корректно сформированную коллекцию объектов
            return [
                'list' => $this->_filterModel->buildModels(),
                'pagination' => ($this->paginationAsHTML)
                        ? LinkPager::widget([
                                'pagination' => $dataProvider->getPagination()
                            ])
                        : $dataProvider->getPagination()
            ];
        }

        return $this->controller->render($this->view ?: $this->id, [
                'filterModel' => $this->_filterModel,
                'dataProvider' => $dataProvider
            ]);

    }

    public function setFilterModel(FilterModelBase $model)
    {
        $this->_filterModel = $model;
    }

    public function setValidationFailedCallback(callable $callback)
    {
        $this->_validationFailedCallback = $callback;
    }
}