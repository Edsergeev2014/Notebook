<?php


namespace app\controllers\actions\activity;


use app\base\BaseAction;
use app\models\Activity;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

class CreateAction extends BaseAction
{
    //public $name;
    public function run() {

        if(!\Yii::$app->rbac->canCreateActivity()){
            throw new HttpException(403, 'Not Authorized Action');
        }
        $model = new Activity();
        if (\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());
            if(\Yii::$app->request->isAjax){
                \Yii::$app->response->format=Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            if(!\Yii::$app->activity->createActivity($model)) {
                print_r($model->getErrors());
            }else{
                return $this->controller->render('view',['model'=>$model]);
            }
        }
        return $this->controller->render('create',['model'=>$model]);
    }
}