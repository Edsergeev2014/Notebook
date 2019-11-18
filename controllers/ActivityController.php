<?php


namespace app\controllers;

use app\base\BaseController;
use app\controllers\actions\activity\CreateAction;

class ActivityController extends BaseController
{
    public function actions()
    {
        return [
            'create'=>['class'=>CreateAction::class],
        ];
    }
}