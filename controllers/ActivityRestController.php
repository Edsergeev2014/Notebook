<?php

namespace app\controllers;


use app\models\Activity;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class ActivityRestController extends ActiveController
{
    public $modelClass=Activity::class;

    public function behaviors()
    {
        $beh =parent::behaviors();
        $beh['authenticator']=[
            'class'=>HttpBearerAuth::class
        ];
        return $beh;
    }
}

