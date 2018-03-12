<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VenueSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="venue-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'telphone') ?>

    <?= $form->field($model, 'manager') ?>

    <?= $form->field($model, 'imglogo') ?>

    <?php // echo $form->field($model, 'imghead') ?>

    <?php // echo $form->field($model, 'imglist') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'shophours') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'paykomw') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
