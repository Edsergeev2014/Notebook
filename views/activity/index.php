<?php

/* @var $this \yii\web\View */
/* @var $model \app\models\ActivitySearch */
/* @var $provider \yii\data\ActiveDataProvider */

use yii\grid\GridView;

?>
<div class="row">
    <div class="col-md-12">
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $provider,
            'filterModel' => $model,
            'columns' => [
                ['class'=>\yii\grid\SerialColumn::class],
                'id',
                [
                    'attribute'=>'title',
                    'label' => 'Название активности',
                    'value' => function($model){
                        return \yii\helpers\Html::a(\yii\helpers\Html::encode($model->title),['/activity/view2','id'=>$model->id]);
                    },
                    'format' => 'raw'
                ],
                'dateStart',
                'userId',
                'createAt',
                [
                    'attribute' => 'user.email'
                ]

            ]
        ]); 
        ?>
    </div>
</div>