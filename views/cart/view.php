<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Cart $model */

$this->title = $model->id_cr;
$this->params['breadcrumbs'][] = ['label' => 'Carts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cart-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('plus', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['update', 'id_cr' => $model->id_cr], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_cr' => $model->id_cr], [
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
            'id_cr',
            'id_user',
            'id_product',
            'count',
        ],
    ]) ?>

</div>
