<?php

namespace app\rules;

use app\models\Activity;
use yii\rbac\Item;
use yii\rbac\Rule;
use yii\db\ActiveRecord;


class OwnerActivityRule extends Rule
{
    public $name='ownerActivityRule';

    /** 
     * Execute the rule.
     * 
     * @param string/int $user [[\yii\web\User::id]] the user ID
     * @param Item $item
     * @param array @params
     * @return bool a value
     * */

    public function execute($user, $item, $params):bool
    {
        /** @var Activity $activity */

        // Где-то здесь ошибка: не пердает данные массива $params

        $activity=$params['activity'];

        return $activity->userId==$user;
        
    }
}