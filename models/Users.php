<?php

namespace app\models;
use yii\web\IdentityInterface;

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
class Users extends UsersBase implements IdentityInterface
{
    public $password;

    private const SCENARIO_SIGNUP='signUp';
    private const SCENARIO_SIGNIN='signIn';

    public function scenarioSignUp() {
        $this->setScenario(self::SCENARIO_SIGNUP);
    }
    
    public function scenarioSignIn() {
        $this->setScenario(self::SCENARIO_SIGNIN);
    }

    
    public function rules()
    {
        return array_merge([
            ['password','required'],
            [['email'],'unique','on'=>self::SCENARIO_SIGNUP],
            [['email'],'exist','on'=>self::SCENARIO_SIGNIN],
        ], parent::rules());
    }

    public static function findIdentity($id) {
        return Users::find()->andWhere(['id'=>$id])->one();
    }

    public static function findIdentityByAccessToken($token, $type = null) {

    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->email;
    }

    public function getAuthKey() {
        return $this->authKey;
    }

    public function validateAuthKey($authKey) {
        return $this->authKey==$authKey;
    }
}
