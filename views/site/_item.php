<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $item app\models\Items */
?>


<div class="container">
    <div class="col-md-6">
        <img class="img-responsive goods-image" src="<?= $item->getImageUrl(true) ?>">
    </div>
    <div class="col-md-6 mist">
       <h2 class="head-chapter"><?= Html::a($item->title, ['/site/view', 'id' => $item->id]) ?></h2>
        <?= $this->render('_cartBlock_0', ['item' => $item]) ?>
        <p class="short-describe"><?= $item->description_short ?></p>
        <div class="row cen">
<?= Html::a(Yii::t('app', 'Докладно') ,['/site/view', 'id' => $item->id], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>
