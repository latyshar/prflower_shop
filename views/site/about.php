<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'О нас';
$this->params['breadcrumbs'][] = $this->title;
echo '
<div class="site-about">
    <h1>
  О нас
</h1>

    <p>
        Новинки:
    </p>
';


$articles=\app\models\Product::find()->orderBy(['date_p'=>SORT_DESC])->limit(5)->all();


$items=[];
foreach ($articles as $article)
{
    $items[]="<h1 class='text-center m-2'>{$article->name_p}</h1>
<div style=' background-color:#CCCCCC; height: 30%' class=' m-2 p-2 d-flex flex-column justify-content-center' >
<img class='m-auto w-50' src='{$article->img}' alt='photo'/></div>";}
echo yii\bootstrap5\Carousel::widget(['items'=>$items]);
?>