<?php

namespace app\rules;

use app\models\Activity;
use yii\rbac\Item;
use yii\rbac\Rule;


class OwnerActivityRule extends Rule 
{
    public $name='ownerActivityRule';

    /** 
     * Execute the rule.
     * 
     * @param string/int $user [[\yii\web\User::id]]
     * @return \yii\db\Activity
     * @param Item 
     * @param array @params
     * @return bool 
     * */

    public function execute($user, $item, $params):bool
    {
        /** @var Activity $activity */

        // Где-то здесь ошибка: не пердает данные массива $params

        $activity=$params['activity'];

        return $activity->userId==$user;
    }
}