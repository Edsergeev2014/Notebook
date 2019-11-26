<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $passwordHash
 * @property string $authKey
 * @property string $token
 * @property string $createAt
 *
 * @property Activity[] $activities
 */
class Users extends UsersBase
{
    public $password;
    
    public function rules()
    {
        return array_merge([
            ['password','required']
        ],parent::rules());
    }

    
}
