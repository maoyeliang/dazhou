<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = 'Update User: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password1')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password2')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'venue_id')->dropDownList(
            \common\models\Venue::find()
                ->select(['name','id'])
                ->indexBy('id')
                ->column(),
            ['prompt' =>'请选择门店']
        ); ?>

        <?= $form->field($model, 'headphoto')->widget('manks\FileInput', [
            'clientOptions' => [
                'server' => 'venue/uploadlogo',
            ],
        ]); ?>

        <?= $form->field($model, 'phone')->textInput() ?>

        <?= $form->field($model, 'status')->dropDownList(
            [   '0' => '未激活',
                '1' => '已激活',
                '2' => '已锁定',
                '3' => '已停用']
        ); ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
