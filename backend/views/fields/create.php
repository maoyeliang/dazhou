<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Fields */
/* @var $form yii\widgets\ActiveForm */


$this->title = '新增场地';
$this->params['breadcrumbs'][] = ['label' => 'Fields', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fields-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="fields-form">

        <?php $form = ActiveForm::begin(); ?>


        <?= $form->field($model, 'type')->textInput() ?>

        <?= $form->field($model, 'vip_type')->textInput() ?>

        <?= $form->field($model, 'material')->textInput() ?>


        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
