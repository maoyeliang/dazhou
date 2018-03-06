<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'venue_id')->textInput() ?>

    <?= $form->field($model, 'headphoto')->textInput(['maxlength' => true]) ?>

    <?=  $form->field($model, 'headphoto')->widget('manks\FileInput',[]);?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?=

//    $array = [
//        ['id' => '0', 'name' => '未激活' ],
//        ['id' => '1', 'name' => '已激活' ],
//        ['id' => '2', 'name' => '已锁定' ],
//        ['id' => '3', 'name' => '已停用' ],
//    ];
//    $listData=\yii\helpers\ArrayHelper::map($array,'id','name');
//
//    var_dump($listData);
    $form->field($model, 'status')->dropDownList(
            [
                '0' => '未激活',
                '1' => '已激活',
                '2' => '已锁定',
                '3' => '已停用']); ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
