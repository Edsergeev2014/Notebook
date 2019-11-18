<?php

namespace app\components;

use app\base\BaseComponent;
// use app\models\Activity;
// use phpDocumentor\Reflection\Types\Boolean;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class FileSaverComponents extends BaseComponent
{
    public function saveFile(UploadedFile $file): ?string
    {
        $name = $this->genFileName($file);
        $path = $this->getPathToSave() . $name;

        if ($file->saveAs($path)) {
            return $name;
        }

        return null;
    }

    private function getPathToSave()
    {
        // Формируем путь с учетом Алиасов в файле конфигурации web.php
        $path = \Yii::getAlias('@webroot').\Yii::getAlias('@filesWeb/');
        // $path = \Yii::getAlias('@webroot/files/');
        FileHelper::createDirectory($path);
        return $path;
    }

    private function genFileName(UploadedFile $file)
    {
        return time() . "_" . $file->getBaseName() . '.' . $file->getExtension();
    }
}