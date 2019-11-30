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
            // заполняем массив после обработки формы запроса
            $model->load(\Yii::$app->request->post());

            // проверка содержимого массива $model
                // echo 'pre';
                // var_dump ($model);
                // echo '/pre';
                // exit;

            // проверка на наличие e-mail в базе данных
            if($this->auth->signUp($model)){
                // если уже есть - переходим на форму Входа в систему
                return $this->redirect(['/auth/sign-in']);
            }
        }
        // переходим на форму входа в систему, после Регитстрации (и записи в БД)
        return $this->render('sign-up',['model'=>$model]);
    }

    public function actionSignIn(){
        $model=new Users();

        // Если форму заполнили, то 
        if(\Yii::$app->request->isPost){
            // echo '<br/><br/><br/>Страница входа в систему (форма заполнена, model - ещё нет): <br/>';
            // echo '<pre>';
            // var_dump ($model);
            // echo '</pre>';
            // заполняем массив после обработки формы запроса
            $model->load(\Yii::$app->request->post());
            // echo '<br/><br/><br/><b>Содержимое формы после загрузки: </b><br/>';
            // echo '<pre>';
            // var_dump ($model);
            // echo '</pre>';
            // exit;

            // проверка на наличие e-mail в базе данных
            if($this->auth->signIn($model)){
                // если уже есть - переходим на форму создания события
                // echo '<br/><br/><br/><b>Содержимое this->auth: </b><br/>';
                // echo '<pre>';
                // var_dump ($this->auth);
                // echo '</pre>';
                // exit;
                return $this->redirect(['/activity/create']);
            }
        }
        // переходим на форму входа в систему, после Регитстрации (и записи в БД)
        // echo '<br/><br/><br/><b>Страница входа в систему (пустая форма): </b><br/>';
        // echo '<pre>';
        // var_dump ($model);
        // echo '</pre>';

        return $this->render('sign-in',['model'=>$model]);
    }
}
