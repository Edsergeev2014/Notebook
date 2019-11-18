<?php


namespace app\components;


use app\base\BaseComponent;
use app\models\Day;

class DayComponents extends BaseComponent
{
    public function today(Day $day) {
        $day->date = date('jS \of F Y');
        $day->time = date('h:i:s A');
        $day->titleDay= date('l');
        if($day->titleDay === 'Saturday' || $day->titleDay === 'Sunday') {
            $day->isWeekend = true;
        } else
            $day->isWeekend = false;
        if(!$day->activity) {
            !$day->activity = 'Событий не запланировано';
        }
        return $day;
    }
}