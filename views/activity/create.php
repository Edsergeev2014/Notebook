<?php
/**
 * @var $model \app\models\Activity
 */
?>

<h1>Создание активности</h1>
<div class="row">
    <div class="col-md-4">
        <?php $form = \yii\bootstrap\ActiveForm::begin([
//            'enableAjaxValidation' => true,
//            'enableClientValidation' => false
        ]); ?>
        <?= $form->field($model, 'title'); ?>
        <?= $form->field($model, 'author'); ?>
        <?= $form->field($model, 'description')->textarea(); ?>
        <?= $form->field($model, 'date'); ?>
        <?= $form->field($model, 'time')->input('time'); ?>
        <?= $form->field($model, 'isBlocked')->checkbox(); ?>
        <?= $form->field($model, 'isRepeat')->checkbox(); ?>
        <?= $form->field($model, 'repeatType')->dropDownList([0=>'Каждый день',5=>'Каждый год']) ?>

        <?= $form->field($model, 'useNotification')->checkbox(); ?>
        <?= $form->field($model, 'email', ['enableClientValidation' => false, 'enableAjaxValidation' => true]); ?>
        <?= $form->field($model, 'repeatEmail', ['enableClientValidation' => false, 'enableAjaxValidation' => true]); ?>
        <?=$form->field($model,'file')->fileInput()?>

        <button type="submit" class="btn-default">Save</button>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
        <?= $model->title ?>
    </div>
</div>
