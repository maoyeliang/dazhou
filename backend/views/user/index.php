<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $form yii\widgets\ActiveForm */

$this->title = '用户管理';

$this->params['breadcrumbs'][] = $this->title;
?>


<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增用户', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<!---->
<!--    --><?php //$form = ActiveForm::begin([
//        'action' => ['index'],
//        'method' => 'get',
//    ]); ?>
<!--    --><?//= $form->field($searchModel, 'username')
//        ->label(false)
//        ->textInput(['placeholder' => '输入用户名进行搜索']) ?>
<!--    --><?//= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
<!--    --><?//= Html::resetButton('高级搜索', ['class' => 'btn btn-default']) ?>
<!--    --><?php //ActiveForm::end(); ?>

    <?= GridView::widget([
            'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',
            ],
            //     ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'nickname',
            'phone',
            'email:email',
            [
                    'attribute' => 'venue_id',
                    'value' => 'venue.name',
            ],
            'headphoto',
            'status',
            'last_time:datetime',
            'updated_time:datetime',
            'created_time:datetime',
        ],

    ]); ?>
</div>
