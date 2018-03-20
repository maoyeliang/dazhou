<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

<!--    --><?//= $form->field($model, 'auth_key') ?>
<!---->
<!--    --><?//= $form->field($model, 'password_hash') ?>
<!---->
<!--    --><?//= $form->field($model, 'password_reset_token') ?>

    <?php  echo $form->field($model, 'email') ?>

    <?php  echo $form->field($model, 'nickname') ?>

    <?php  echo $form->field($model, 'stadiums_id') ?>

    <?php  echo $form->field($model, 'headphoto') ?>

    <?php  echo $form->field($model, 'phone') ?>

    <?php  echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'last_time') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
