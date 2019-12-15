<?php
/**
 * @var $title string
 */
?>

<h3><?=$title?></h3>
<?php $form=\yii\bootstrap\ActiveForm::begin(); ?>
<?=$form->field($model, 'email'); ?>
<?=$form->field($model, 'password')->passwordInput(); ?>
<div class='form-group'>
    <button type='submit' class='btn btn-default'>Авторизация</button>
</div>

<?php \yii\bootstrap\ActiveForm::end(); ?>

