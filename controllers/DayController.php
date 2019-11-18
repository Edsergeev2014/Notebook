<?php


namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\day\IndexAction;

class DayController extends BaseController
{
    public function actions()
    {
        return [
            'index'=>['class'=>IndexAction::class]
        ];
    }
}