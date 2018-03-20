<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Stadiums */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="venue-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telphone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manager')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imglogo')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'imglogo')->widget('manks\FileInput', [
        'clientOptions' => [
            'server' => 'venue/uploadlogo',
        ]
    ]); ?>
    <?= $form->field($model, 'imghead')->widget('manks\FileInput', [
        'clientOptions' => [
            'server' => 'venue/uploadhead',
        ]
    ]); ?>

    <?= $form->field($model, 'imglist')->widget('manks\FileInput', [
        'clientOptions' => [
            'server' => 'venue/uploadlist',
            'pick' => [
                'multiple' => true,
            ],

        ]
    ]); ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shophours')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'paykomw')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
