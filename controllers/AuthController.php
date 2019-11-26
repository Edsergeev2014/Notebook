<?php

namespace app\controllers;

use app\models\Users;
use yii\base\Controller;

class AuthController extends \yii\web\Controller
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->auth=\Yii::$app->auth;
    }

    /** 
     * @var AuthComponent
     */

    private $auth;

    public function actionSignUp()
    {
        $model=new Users();

        if(\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());

            // где-то здесь ошибка авторизации

            if($this->auth->signUp($model)){
                // var_dump ($model); exit;
                return $this->redirect(['/auth/sign-in']);
            }
            else {
                // var_dump ($this->auth);
            }
        }
        // var_dump ($model->email); exit;
        return $this->render('sign-in',['model'=>$model]);
    }

}
