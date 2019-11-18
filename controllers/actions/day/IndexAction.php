<?php


namespace app\controllers\actions\day;


use app\base\BaseAction;
use app\models\Day;

class IndexAction extends BaseAction
{
    public function run() {
       $day = new Day();
       \Yii::$app->day->today($day);
        return $this->controller->render('indexDay',['day'=>$day]);
    }
}