<?php


namespace app\controllers;

use app\base\BaseController;
use app\controllers\actions\activity\CreateAction;
use app\models\Activity;
use yii\web\HttpException;
use yii\helpers\Html;
use app\models\ActivitySearch;

class ActivityController extends BaseController
{
    public function actions()
    {
        return [
            'create'=>['class'=>CreateAction::class],
        ];
    }

    public function actionIndex()
    {
        $model = new ActivitySearch();
        $provider=$model->search(\Yii::$app->request->getQueryParams());

        return $this->render('index', ['model'=>$model,'provider'=>$provider]);
    }

    public function actionView2($id){
        $model=Activity::findOne($id);

        // echo 'Содержимое строки Activity:<br/>';
        // Html::tag('pre', print_r($model->title));
        // exit;

        if(!\Yii::$app->rbac->canViewActivity($model)){
            throw new HttpException(403,'Not access to acvtivity');
        }

        if(!$model){
            throw new HttpException(404, 'Activity not found');
        }

        return $this->render('view2',['model'=>$model]);
    }
}