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

        if ($activity->validate()) {
            
            // проверка наличия файла и сохранение
            if ($activity->file) {

                $activity->file = \Yii::$app->fileSaver->saveFile($activity->file);
                if (!$activity->file) {
                    return false;
                }else{
                    $activity->files=null;
                }
            }
            if($activity->save(false)){
                return true;
            }
            return false;
        }
        
        return false;
    }
}