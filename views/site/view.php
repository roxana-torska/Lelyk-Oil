<?php
/* @var $this yii\web\View */
/* @var $item app\models\Items */
$this->title = $item->title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-view">
  <div class="container">
      <div class="row">
        <div class="col-md-12">
            <img class="img-responsive center-img" src="<?= $item->getImageUrl(true) ?>">
        </div>
      </div>
      <div class="row item-content">
       <div class="col-md-6">

           <h1 class="head-chapter"><?= $item->title ?></h1>
       </div>
        <div class="col-md-6 cart-block mist">
    
            <?= $this->render('_cartBlock', ['item' => $item]) ?>
        </div>
        </div>
        <div class="row">
        <div class="col-md-12">
        <p class="goods-description"><?= $item->description ?></p>
        </div>
        </div>
      
  </div>
</div>
