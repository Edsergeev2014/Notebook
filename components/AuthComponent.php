<?php

namespace app\components;

use app\base\BaseComponent;
use app\models\Users;

class AuthComponent extends BaseComponent 
{
    public function signIn(Users $model): bool
    {
        $model->scenarioSignIn();

        if(!$model->validate(['email','password'])) {

            // echo '<br/><br/><br/><b>Проверка signIn в AuthComponent: </b><br/>';
            // echo '<pre>';
            // var_dump ($model);
            // echo '</pre>';
            // exit;


            return false;
        }
        $user = $this->getUserByEmail($model->email);

        if(!$this->validatePassword($model->password,$user->passwordHash)){
            $model->addError('password', 'Неверный пароль');
            return false;
        }
        return \Yii::$app->user->login($user);

    }

    private function validatePassword($password, $passwordHash): bool
    {
        return \Yii::$app->security->validatePassword($password, $passwordHash); {
        
            return false;
        }
    }
    
    public function getUserByEmail($email):?Users{
        return Users::find()->andWhere(['email' => $email])->one();
    }

    public function signUp(Users $model): bool
    {
        $model->scenarioSignUp();
        // проверка e-mail и пароля на валидацию
        if(!$model->validate(['email','password'])){
            return false;
        }
        
        // генерация Hash-пароля
        $model->passwordHash=$this->genPasswordHash($model->password);
        // \Yii::$app->security->generateRandomSring();

        // запись в базу данных
        if($model->save()){
            return true;
        }
        return false;
    }

    private function genPasswordHash(string $password){
        return \Yii::$app->security->generatePasswordHash($password);
    }
}