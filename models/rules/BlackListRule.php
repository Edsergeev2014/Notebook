<?php


namespace app\models\rules;


use yii\validators\Validator;

class BlackListRule extends Validator
{
    public $list;


    public function validateAttribute($model, $attribute)
    {
        if(in_array($model->$attribute,$this->list)){
            $model->addError($attribute,'Недопостимое значение заголовока');
        }
    }
}