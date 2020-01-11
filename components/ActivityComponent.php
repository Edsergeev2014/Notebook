<?php

namespace app\components;

use app\base\BaseComponent;
use app\base\FileSaverComponents;
use app\models\Activity;
use phpDocumentor\Reflection\Types\Boolean;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;


class ActivityComponent extends BaseComponent
{
    public function createActivity(Activity $activity)
    {
        $activity->file = UploadedFile::getInstance($activity, 'file');
        $activity->userId=\Yii::$app->user->getIdentity()->id;

        // var_dump($activity->getAttributes());

        // exit;

        // валидация формы
        if ($activity->validate()) {

            
            // проверка наличия файла и сохранение файла
            if ($activity->file) {

                $activity->file = \Yii::$app->fileSaver->saveFile($activity->file);
                if (!$activity->file) {
                    return false;
                }
                // else{
                //     $activity->file=null;
                // }
            }

            // var_dump($activity->getAttributes());exit;

            if($activity->save(false)){
                return true;
            }
            // return false;
        }
        // если валидация формы не прошла
        // print_r($activity->errors); 
        // exit;
        return false;
    }

    public function findTodayNotifActivity()
    {
        return Activity::find()->andWhere('email is not null')
        ->andWhere('dateStart>=:date',[':date'=>date('Y-m-d')])
        ->andWhere('dateStart<=:date1',[':date1'=>date('Y-m-d').' 23:59:59'])->all();
    }
}
