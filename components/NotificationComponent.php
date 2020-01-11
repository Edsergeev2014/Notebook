<?php

namespace app\components;

use Yii\base\Component;
use yii\helpers\ArrayHelper;

class NotificationComponent extends Component
{
    /** @var MailerInterface */
    private $mailer;

    public function getMailer()
    {
        return $this->mailer;
    }

    public function init()
    {
        parent::init();

        $this->mailer=\Yii::$app->mailer;
    }

    /**
     * @param Activity[] $activities
     */
    public function sendNotifications(array $activities)
    {
        echo 'Ready to sent emails... ';

        echo PHP_EOL;

            // echo 'Переменная $activities: '.PHP_EOL;
            // print_r($activities);
            // echo PHP_EOL;

        foreach ($activities as $activity) {
            // compose - то же самое, что и render
            $send=$this->getMailer()->compose('notif',['model'=>$activity])
            ->setSubject('Активность '.$activity->id.' стартует сегодня')
            ->setFrom('ed.sergeev2016@yandex.ru')
            ->setReplyTo('ed.sergeev2014@yandex.ru')
            ->setTo($activity->email)
            ->send();

            // echo PHP_EOL;
            // echo 'Переменная $send: '.PHP_EOL;
            // print_r($send);
            // echo PHP_EOL;

            
            echo 'Переменная $activity: '.PHP_EOL;
            print_r($activity);
            echo PHP_EOL;

            echo 'Sending emails to... '.$activity->email.PHP_EOL;

            if(!$send){
                if(\Yii::$app instanceof \yii\console\Application)
                {
                    echo 'Error email send to id#'.$activity->id.', email: '.$activity->email.PHP_EOL;
                }
                return false;
            }

            if(\Yii::$app instanceof \yii\console\Application)
            {
                echo 'Email success send to '.$activity->email.PHP_EOL;
            }
        }
    }
}

