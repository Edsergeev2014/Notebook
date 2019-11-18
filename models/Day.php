<?php


namespace app\models;


use app\base\BaseModel;

class Day extends BaseModel
{
    public $date;
    public $time;
    public $titleDay;
    public $isWeekend;
    public $activity;

    public function rules()
    {
        return [
           [['date','time','titleDay','activity'],'string'],
            ['isWeekend','boolean']
        ];
    }
}