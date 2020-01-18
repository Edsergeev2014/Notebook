<?php


namespace app\controllers\actions\activity;


use app\base\BaseAction;
use app\models\Activity;
use yii\bootstrap\ActiveForm;
use yii\web\Response;
use yii\web\HttpException;

class CreateAction extends BaseAction
{
    //public $name;
    public function run() {

        if(!\Yii::$app->rbac->canCreateActivity()){
            throw new HttpException(403, 'Not Authorized Action');
        }
        $model = new Activity();
        if (\Yii::$app->request->isPost){
            // загружаем из формы в модель
            $model->load(\Yii::$app->request->post());

            // если запрос асинхронный, возвращаем отвалидированную форму
            if(\Yii::$app->request->isAjax){
                \Yii::$app->response->format=Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            // вызываем метод добавления активности
            if(\Yii::$app->activity->createActivity($model)) {
                // ! - если нет, то выводим ошибку // убрали
                // print_r($model->getErrors());

                // а если все верно, то переходим на сохранение
                return $this->controller->redirect(['/activity/view','id'=>$model->id]);
            }
            
            // результат в случае успеха // убрали
            // else{
            //     return $this->controller->render('view',['model'=>$model]);
            // }
        }
        return $this->controller->render('create',['model'=>$model]);
    }
}