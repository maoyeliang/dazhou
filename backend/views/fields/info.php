<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Fields */
/* @var $form yii\widgets\ActiveForm */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fields', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fields-view">
    <?php $form = ActiveForm::begin(['method'=>'get','action'=>\yii\helpers\Url::to(["/fields/info"])]); ?>
    <input  name="datetime" type="date"  value=<? echo date("Y-m-d",intval($datetime));?>>
    <?= Html::submitButton('查看', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>

    <table class="table table-hover">
        <?php foreach ($fieldstime as $key => $value) { ?>
        <tr>
            <?php $form = ActiveForm::begin(['action'=>\yii\helpers\Url::to(["/fields/edit"])]); ?>

            <td><?= $key; ?>号场地</td>

            <?php foreach ($value as $timekey => $timevalue)  { ?>
                <?php if (!count($timevalue)) { ?>
                    <td> <?=Html::checkbox('fieldsinfo[]', false, ['value' => $timekey]);?><?= $timekey ?>点未设置</td>
                <?php }else{ ?>
                    <td style="background:chartreuse"> <?= $timekey ?>点可预约</td>
                <?php } ?>

            <?php } ?>
            <input type="hidden" name="dateinfo" value=<?=$datetime?>>
            <input type="hidden" name="fieldid" value=<?=$key?>>
            <td> <?= Html::submitButton('设置', ['class' => 'btn btn-success']) ?></td>
            <?php ActiveForm::end(); ?>

            <?php } ?>
    </table>
</div>

</div>
