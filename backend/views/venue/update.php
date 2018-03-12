<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Venue */

$this->title = 'Update Venue: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Venues', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="venue-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
