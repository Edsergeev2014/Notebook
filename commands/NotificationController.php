<?php

namespace app\commands;

use app\components\NotificationComponent;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use yii\console\Controller;
use yii\helpers\Console;

class NotificationController extends Controller
{
    public $name;

    // php yii notification/test ItsMyName Sergy Евгений --n=Eduard
    public function options($actionID)
    {
        return ['name'];
    }

    // php yii notification/test ItsMyName Sergy Евгений -n=Eduard
    public function optionAliases()
    {
        return [
            'n' => 'name'
        ];
    }

    // php yii notification/test ItsMyName Sergy Евгений
    public function actionTest(...$arg) 
    {
        echo 'test action '.$this->name.PHP_EOL;

        print_r($arg);
    }

    public function actionSendTodayActivity()
    {
        // Получаем список активных событий (e-mail) из базы 
        $activities=\Yii::$app->activity->findTodayNotifActivity();
        if (count($activities)==0) {
            echo Console::ansiFormat('Не найдено email в базе данных (по вашему критерию отбора)',[Console::FG_RED, Console::BG_BLACK]).PHP_EOL;
            \Yii::$app->end(0);
        }

        /**
         * @var NotificationComponent $notif
         */
        $notif=\Yii::createObject(NotificationComponent::class);

        echo Console::ansiFormat('Найдено активных записей в базе данных:'.count($activities),[Console::FG_GREEN, Console::BG_BLACK]).PHP_EOL;

        // echo 'Переменная $activities в Контроллере: '.PHP_EOL;
        // print_r($activities);
        // echo PHP_EOL;

        $notif->sendNotifications($activities);
    }
}