<?php

namespace app\controllers;


use app\models\Activity;
use yii\rest\ActiveController;

class ActivityRestController extends ActiveController
{
    public $modelClass=Activity::class;
}

