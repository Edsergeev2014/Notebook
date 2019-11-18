<?php


namespace app\base;


use yii\base\Action;

class BaseAction extends Action
{
    public function beforeRun()
    {
//        $this->controller->view->params['lastPage']=\Yii::$app->session->get('lastPage','');
        return parent::beforeRun();
    }
}