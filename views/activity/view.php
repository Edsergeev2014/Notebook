<?php
/**
 * @var $model \app\models\Activity
 * @var $this \yii\web\View
 */

?>
<?=\yii\helpers\Html::tag('h2', \yii\helpers\Html::encode($model->title)) ?>

<!-- Пример использования алиаса: -->
<!-- <?=Yii::getAlias('@app')?> -->
<br/>

<?php
    // Пример работы с массивами
    // Добавление данных в массив:
    $data=['first'=>'one','two'=>['three'=>'value']];
    // Отображение данные из массива:
    echo \yii\helpers\ArrayHelper::getValue($data,'firstsss','def').'<br/>';
    echo \yii\helpers\ArrayHelper::getValue($data,'two.three').'<br/>';

    $data=[
        ['name'=>'Артем','login'=>'Artemy','id'=>5],
        ['name'=>'Василий','id'=>2,'login'=>'Vasily'],
        ['name'=>'Семен','id'=>'4','login'=>'Semeon'],
        ['name'=>'Иван','id'=>'3','login'=>'Ivan']
    ];

    $list=\yii\helpers\ArrayHelper::map($data,'id',function ($arr){
        return \yii\helpers\ArrayHelper::getValue($arr,'name').', '.
            \yii\helpers\ArrayHelper::getValue($arr,'login').'<br/>';
    });
    
    // Сортируем массив:
    \yii\helpers\ArrayHelper::multisort($list, ['id', 'name'], [SORT_ASC, SORT_DESC]);

    //Выводим на экран:
    \yii\helpers\Html::tag('pre', print_r($list));
?>

</br>
<ul>
    <li><strong>Автор: </strong><?=$model->author?></li>
    <li><strong>Описание: </strong><?=$model->description?></li>
    <li><strong>Дата: </strong><?=$model->date?></li>
    <li><strong>Время: </strong><?=$model->time?></li>
    <li><strong>Файл: <br/></strong>
        <?=
            // Демонстрация загруженных файлов
            // \yii\helpers\Html::img(Yii::getAlias('@filesWeb/'.$model->file),[
            \yii\helpers\Html::img(Yii::getAlias('@web').Yii::getAlias('@filesWeb/'.$model->file),[    
            'width'=>200,'title'=>'Картинка'
        ])
        ?>
    </li>
    <li><strong>Ссылка на файл: <br/></strong>
        <?=
            \yii\helpers\Html::tag('a', Yii::getAlias('@web').Yii::getAlias('@filesWeb/'.$model->file))
        ?>
    </li>
        <ul><strong>Альтернативные ссылки на файл: <br/></strong>
            
            <li>
                <?=
                \yii\helpers\Html::tag('a', Yii::getAlias('@filesWeb/'.$model->file))
                ?>
            </li>
            <li>
                <?=
                \yii\helpers\Html::tag('a', Yii::getAlias('@web/files/'.$model->file))
                ?>
            </li>
            <li>
                <?=
                \yii\helpers\Html::tag('a', Yii::getAlias('@webroot').Yii::getAlias('@filesWeb/'.$model->file))
                ?>
            </li>
        </ul>
</ul>
<pre>
    <?php
    print_r($model);
    ?>
</pre>

<?
//    echo \yii\helpers\Html::tag('h1', \yii\helpers\ArrayHelper::getValue($model)) 
?>

<!-- Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere, exercitationem sequi natus necessitatibus possimus quos magni nulla ad dolores, eveniet aut suscipit esse! Temporibus facere unde hic adipisci beatae dolor. -->