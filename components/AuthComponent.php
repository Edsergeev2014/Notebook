<?php

namespace app\components;

use app\base\BaseComponent;
use app\models\Users;

class AuthComponent extends BaseComponent 
{
    public function signIn(Users $model): bool
    {
        
    }

    public function signUp(Users $model): bool
    {
        if($model->validate(['email','password'])){
            return false;
        }
        
        $model->passwordHash=$this->genPasswordHash($model->password);
        // \Yii::$app->security->generateRandomSring();


        if($model->save()){
            return true;
        }
        return false;
    }

    private function genPasswordHash(string $password){
        return \Yii::$app->security->generatePasswordHash($password);
    }
}