<?php
/* @var $this yii\web\View */
/* @var $model app\models\Users */
?>

<div class='row'>
    <div class='col-md-6'>
    <?=\app\widgets\AuthForm\AuthFormWidget::widget(['title'=>'Регистрация:','model'=>$model])?>
    </div>
</div>
<br/>

