<?php

use app\models\Cart;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CartSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_cr',
            //'id_user',
            ['attribute'=>'Имя', 'value'=> function($data){return
                $data->getUser()->One()->surname;}],
            //'id_product',
            ['attribute'=>'Название', 'value'=> function($data){return
                $data->getProduct()->One()->name_p;}],
            'count',


            [
                'class' => ActionColumn::className(),

                'urlCreator' => function ($action, Cart $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_cr' => $model->id_cr]);
                 }
            ],
        ],
    ]); ?>
    <label class="form-label" style="margin-top: 20px;">Чтобы сформировать заказ введите пароль</label>
    <input type="password" id="pass" class="form-control" style="margin-top: 10px;">
    <div type="button" onclick="order_confirm()" class="btn btn-danger" style="margin-top: 20px;">Сформировать заказ</div>

    <script src="/web/js/order.js"></script>

</div>
