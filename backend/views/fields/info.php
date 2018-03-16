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
    <?php $form = ActiveForm::begin(['method' => 'get', 'action' => \yii\helpers\Url::to(["/fields/info"])]); ?>
    <input name="datetime" type="date" value=<? echo date("Y-m-d", intval($datetime)); ?>>
    <?= Html::submitButton('查看', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>

    <table class="table table-bordered">
        <?php $form = ActiveForm::begin(['action' => \yii\helpers\Url::to(["/fields/edit"])]); ?>

           <span style="font-size: 30px">选择类型：</span>
           <select  name='type' style="width: 200px" class="form-control">
                    <option value="0">未设置</option>
                    <option value="1" selected>可预约</option>
                    <option value="4">禁止预定</option>
                    <option value="5">其他</option>
                </select>
            <span style="font-size: 30px">设置价格：</span>
            <input style="width: 200px" type="text" class="form-control" placeholder="可预约时价格必填" name="money">
            <?= Html::submitButton('一键设置', ['class' => 'btn btn-primary btn-lg']) ?>


        <?php foreach ($fieldstime as $key => $value) { ?>
        <tr >

            <td><?= $key; ?>号场地</td>
            <?php foreach ($value as $timekey => $timevalue) { ?>
                <?php if (!count($timevalue) && $timevalue->state == 0) { ?>
            <!--0未设置，1可预约，2待支付，3已经预约，4禁止预约，5其他-->
                    <td>
                            <label>
                                <?= Html::checkbox("fieldsinfo[$key][]", false, ['value' => $timekey]); ?><?= $timekey ?>
                                点</br></br>未设置
                            </label>
                    </td>

                <?php } else if ($timevalue->state ==1){ ?>
                    <td style="background:chartreuse">
                        <label>
                            <?= Html::checkbox("fieldsinfo[$key][]", false, ['value' => $timekey]); ?><?= $timekey ?>
                            点</br></br>可预约
                        </label>
                    </td>
                <?php } else if ($timevalue->state ==2){ ?>

                    <td style="background:#c6e9a1">
                        <label>
                            待支付</br></br>
                            <a class="btn btn-warning" href="#" role="button">查看订单</a>

                        </label>
                    </td>
                <?php } else if ($timevalue->state ==3){ ?>
                    <td style="background:#c6e9a1">
                        <label>
                            已支付</br></br>
                            <a class="btn btn-success" href="#" role="button">查看订单</a>
                        </label>
                    </td>
                <?php } else{ ?>
                    <td style="background:#c0c0c0">
                        <label>

                            <label>
                                <?= Html::checkbox("fieldsinfo[$key][]", false, ['value' => $timekey]); ?></br></br>其他
                            </label>
                        </label>
                    </td>
                <?php } ?>
            <?php } ?>
            <input type="hidden" name="dateinfo" value=<?= $datetime ?>>
            <td> <?= Html::button('全选', ['class' => 'btn btn-success']) ?></td>
            <td> <?= Html::button('反选', ['class' => 'btn btn-success']) ?></td>

            <?php } ?>
            <?php ActiveForm::end(); ?>
    </table>
</div>
