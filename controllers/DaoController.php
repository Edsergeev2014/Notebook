<?php

namespace app\controllers;

use yii\caching\FileCache;
use app\base\BaseController;
use yii\web\Controller;

class DaoController extends BaseController
{
    public function actionCache()
    {
        // Устанавливаем кэш:
        \Yii::$app->cache->set('key1','valume1');

        // Сбросить кэш:
        // \Yii::$app->cache->flush();

        // Удаляем кэш:
        // \Yii::$app->cache->delete('key1');

        // Устанавливаем или считываем кэш
        $val1=\Yii::$app->cache->get('key1');
        $val2=\Yii::$app->cache->getOrSet('key2',function(){
            return 'valume2';
        });
        $val3=\Yii::$app->cache->getOrSet('key3',function(){
            return 'valume3';
        });
        // \Yii::$app->cache->delete('key3');

        echo $val1.'<br/>';
        echo $val2.'<br/>';
        echo $val3.'<br/>';
    }

}

