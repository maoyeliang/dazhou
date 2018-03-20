<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Stadiums */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Venues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venue-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'telphone',
            'manager',
            'imglogo',
            ['attribute'=>'imglogo',
                'format' => 'raw',
                'value' => function($model){
                    return Html::img(Yii::getAlias('@images/'.$model->imglogo));
                }],
            'imghead',
            ['attribute'=>'imghead',
                'format' => 'raw',
                'value' => function($model){
                    return Html::img(Yii::getAlias('@images/'.$model->imghead));
                }],
            'imglist',
            ['attribute'=>'imglist',
                'format' => 'raw',
                'value' => function($model){
                     $imglist = explode(',',$model->imglist);
                    return Html::img(Yii::getAlias('@images/'.$imglist[0]))
                        .Html::img(Yii::getAlias('@images/'.$imglist[1]))
                        .Html::img(Yii::getAlias('@images/'.$imglist[2]))
                        .Html::img(Yii::getAlias('@images/'.$imglist[3]));
                }],
            'address',
            'location',
            'shophours',
            'state',
            'paykomw',
            'note',
            'description',
            'updated_time:datetime',
            'created_time:datetime',
        ],
    ]) ?>

</div>
