<?php

use app\models\Product;
use app\models\ProductSearch;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Category;
use app\models\CategorySearch;

/** @var yii\web\View $this */
/** @var app\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Каталог';
$this->params['breadcrumbs'][] = $this->title;


/*
echo '
<div class="card" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text"></p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>';*/


echo "<h1>Каталог товаров</h1>
<!--Поместите здесь элементы управления каталогом в соответсвии с заданием-->
";
echo '
    <div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    По цене
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="catalog?sort=price">По возрастанию</a></li>
    <li><a class="dropdown-item" href="catalog?sort=-price">По убыванию</a></li>
  </ul>
  
</div>';


echo '
    <div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    По новизне
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="catalog?sort=date_p">Сначала старые</a></li>
    <li><a class="dropdown-item" href="catalog?sort=-date_p">Сначала новые</a></li>
  </ul>
  
</div>';

echo '
    <div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    По названию
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="catalog?sort=name_p">От А до Я</a></li>
    <li><a class="dropdown-item" href="catalog?sort=-name_p">От Я до А</a></li>
  </ul>
  
</div>';

echo '
    <div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    По стране
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="catalog?ProductSearch[country]=Россия">Россия</a></li>
    <li><a class="dropdown-item" href="catalog?ProductSearch[country]=Китай">Китай</a></li>
  </ul>
  
</div>';

echo '
    <div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    По категориям
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="catalog?ProductSearch[id_category]=1">Цветы</a></li>
    <li><a class="dropdown-item" href="catalog?ProductSearch[id_category]=2">Декорации</a></li>
    <li><a class="dropdown-item" href="catalog?ProductSearch[id_category]">Все</a></li>
  </ul>
  
</div>';

$products = $dataProvider->getModels();
echo "<div class='d-flex flex-row flex-wrap justify-content-start border border-0 border-info align-items-end'>";
foreach ($products as $product) {
    if ($product->count > 0) {
        echo "<div class='card m-1' style=' height: 500px; width: 22%; min-width: 300px;'>
 <a href='/product/view?id={$product->id_p}'><img src='{$product->img}' class='card-img-top' style=' margin-bottom: 0px; max-height: 300px;' alt='image'></a>
 <div class='card-body'>
 <h5 class='card-title'>{$product->name_p}</h5>
 <p class='card-text'>{$product->country}</p>
 <p class='text-danger'>{$product->price} руб</p>";
        echo(Yii::$app->user->isGuest ? "<a href='/product/view?id={$product->id_p}' style='margin-bottom: 0px;' class='btn btn-primary'>Просмотр товара</a>" : "
<p onclick='add_product({$product->id_p},1)' class='btn btn-danger'>Добавить в корзину</p>");
        echo "</div>
</div>";
    }
}
echo "</div>";


?>
