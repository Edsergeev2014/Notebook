<?php


namespace app\controllers;

use app\base\BaseController;
use app\controllers\actions\activity\IndexAction;
use app\controllers\actions\activity\CreateAction;
use app\controllers\actions\activity\ViewAction;
use app\controllers\actions\activity\UpdateAction;
use app\controllers\actions\activity\DeleteAction;
use app\models\Activity;
use yii\web\HttpException;
use yii\helpers\Html;
use app\models\ActivitySearch;
use yii\caching\MemCache;

class ActivityController extends BaseController
{
    // Запросы через API:
    public function actions()
    {
        return [
            'index'=>['class'=>IndexAction::class],
            'create'=>['class'=>CreateAction::class],
            'view'=>['class'=>ViewAction::class],
            'update'=>['class'=>UpdateAction::class],
            'delete'=>['class'=>DeleteAction::class],
            'options'=>['class'=>'yii\rest\OptionsAction'],
        ];
    }

    public function actionIndex()
    {
        $model = new ActivitySearch();
        $provider=$model->search(\Yii::$app->request->getQueryParams());

        return $this->render('index', ['model'=>$model,'provider'=>$provider]);
    }

    public function actionView2($id){

        if(empty($id)){
            return $this->redirect(['/activity/index']);
        }
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

    // Кэширование всей страницы:
    // public function behaviors()
    // {
    //     return [
    //         ['class'=>\yii\filters\PageCache::class,'only'=>['test'],'duration'=>10]
    //     ];
    // }
}